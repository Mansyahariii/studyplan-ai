<?php 
namespace App\Services;
use Carbon\Carbon;

class PriorityService{
    public function calculate(array $data): array{
        $deadlineScore = $this->getDeadlineScore($data['deadline']);
        $difficultyScore = $this->getDifficultyScore($data['difficulty']);
        $durationScore = $this->getDurationScore($data['estimated_duration']);
        $weightScore = $this->getWeightScore($data['task_weight']);
        $totalScore = $deadlineScore + $difficultyScore + $durationScore + $weightScore;

        return [
            'priority_score'=> $totalScore,
            'priority_level'=> $this->getPriorityLevel($totalScore),
        ];
    }

    private function getDeadlineScore($deadline): int{
        $now = Carbon::now();
        $deadlineDate = Carbon::parse($deadline);

        if($deadlineDate->isPast()){
            return 45;
        }

        $hoursLeft = $now->diffInHours($deadlineDate, false);

        if($hoursLeft <= 24){
            return 40;
        }
        
        if($hoursLeft <= 72){
            return 30;
        }
        
        if($hoursLeft <= 168){
            return 20;
        }

        return 10;
    }

    private function getDifficultyScore(string $difficulty): int{
        return match ($difficulty) {
            'tinggi' => 25,
            'sedang' => 15,
            'rendah' => 5,
            default => 5,
        };
    }

    private function getDurationScore(int $duration): int{
        if($duration >= 5){
            return 20;
        }

        if($duration >= 3){
            return 15;
        }

        return 5;
    }

    private function getWeightScore(string $weight): int{
        return match ($weight) {
            'besar' => 15,
            'sedang' => 10,
            'kecil' => 5,
            default => 5,
        };
    }

    private function getPriorityLevel(int $score): string{
        if ($score >= 80){
            return 'sangat_tinggi';
        }

        if ($score >= 60){
            return 'tinggi';
        }

        if ($score >= 40){
            return 'sedang';
        }

        return 'rendah';
    }
}
?>