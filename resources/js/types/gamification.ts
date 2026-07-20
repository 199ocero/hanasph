import type { LucideIcon } from '@lucide/vue';

export type PresenceStatus = 'online' | 'idle' | 'dnd' | 'offline';

export type Rarity = 'common' | 'rare' | 'epic' | 'legendary';

export type Achievement = {
    title: string;
    description: string;
    icon: LucideIcon;
    rarity: Rarity;
    unlocked: boolean;
    unlockedAt?: string;
};

export type LeaderboardEntry = {
    rank: number;
    name: string;
    avatar?: string;
    score: number;
    change: number;
};

export type Quest = {
    title: string;
    description: string;
    current: number;
    max: number;
    xpReward: number;
    claimed: boolean;
};
