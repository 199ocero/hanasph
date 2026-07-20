<?php

namespace App\Services\Gamification;

/**
 * Pure XP <-> level maths. No state, no mutations.
 *
 * Level curve is triangular: the cumulative XP required to *reach* level L is
 * 100 * (L - 1) * L, so each level costs 200 more than the last
 * (L1->2 = 200, L2->3 = 400, L3->4 = 600, ...). Level is always derived from
 * XP and is never stored.
 */
class GamificationService
{
    /**
     * Cumulative XP required to reach the given level (level 1 = 0 XP).
     */
    public function xpForLevel(int $level): int
    {
        return 100 * ($level - 1) * $level;
    }

    /**
     * Break an XP total into its level and progress within that level.
     *
     * @return array{level: int, xpIntoLevel: int, xpForNextLevel: int}
     */
    public function progression(int $xp): array
    {
        $level = 1;

        while ($this->xpForLevel($level + 1) <= $xp) {
            $level++;
        }

        $floor = $this->xpForLevel($level);
        $ceiling = $this->xpForLevel($level + 1);

        return [
            'level' => $level,
            'xpIntoLevel' => $xp - $floor,
            'xpForNextLevel' => $ceiling - $floor,
        ];
    }
}
