import {
    Crown,
    Flame,
    Rocket,
    ShieldCheck,
    Star,
    Swords,
    Target,
    Trophy,
} from '@lucide/vue';
import type { Achievement, LeaderboardEntry, Quest } from '@/types';

export const demoAchievements: Achievement[] = [
    {
        title: 'First Steps',
        description: 'Complete your first quest',
        icon: Star,
        rarity: 'common',
        unlocked: true,
        unlockedAt: '2 weeks ago',
    },
    {
        title: 'On Fire',
        description: 'Reach a 7-day streak',
        icon: Flame,
        rarity: 'rare',
        unlocked: true,
        unlockedAt: '5 days ago',
    },
    {
        title: 'Sharpshooter',
        description: 'Hit 100% accuracy on a challenge',
        icon: Target,
        rarity: 'rare',
        unlocked: true,
        unlockedAt: '3 days ago',
    },
    {
        title: 'Elite Squad',
        description: 'Join a top-10 guild',
        icon: ShieldCheck,
        rarity: 'epic',
        unlocked: false,
    },
    {
        title: 'Speedrunner',
        description: 'Finish 5 quests in a single day',
        icon: Rocket,
        rarity: 'epic',
        unlocked: true,
        unlockedAt: 'yesterday',
    },
    {
        title: 'Arena Champion',
        description: 'Win 10 ranked duels in a row',
        icon: Swords,
        rarity: 'legendary',
        unlocked: false,
    },
    {
        title: 'Trophy Hunter',
        description: 'Unlock 25 achievements',
        icon: Trophy,
        rarity: 'legendary',
        unlocked: false,
    },
    {
        title: 'Crowned',
        description: 'Reach #1 on the leaderboard',
        icon: Crown,
        rarity: 'legendary',
        unlocked: false,
    },
];

export const demoLeaderboard: LeaderboardEntry[] = [
    { rank: 1, name: 'Aria Vance', score: 18420, change: 0 },
    { rank: 2, name: 'Kai Osei', score: 17110, change: 1 },
    { rank: 3, name: 'Mika Torres', score: 16890, change: -1 },
    { rank: 4, name: 'You', score: 14235, change: 2 },
    { rank: 5, name: 'Lena Ford', score: 13980, change: -1 },
    { rank: 6, name: 'Theo Brandt', score: 12760, change: 0 },
];

export const demoQuests: Quest[] = [
    {
        title: 'Daily Login',
        description: 'Sign in 3 days in a row',
        current: 3,
        max: 3,
        xpReward: 50,
        claimed: false,
    },
    {
        title: 'Complete 5 Tasks',
        description: 'Finish any 5 tasks today',
        current: 3,
        max: 5,
        xpReward: 120,
        claimed: false,
    },
    {
        title: 'Invite a Friend',
        description: 'Invite a teammate to join',
        current: 0,
        max: 1,
        xpReward: 200,
        claimed: false,
    },
    {
        title: 'Weekly Challenge',
        description: 'Earn 1,000 XP this week',
        current: 1000,
        max: 1000,
        xpReward: 500,
        claimed: true,
    },
];
