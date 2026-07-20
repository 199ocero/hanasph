<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { CheckCircle2, Crown, Trophy, Zap } from '@lucide/vue';
import AchievementGrid from '@/components/AchievementGrid.vue';
import LeaderboardTable from '@/components/LeaderboardTable.vue';
import LevelBadge from '@/components/LevelBadge.vue';
import QuestList from '@/components/QuestList.vue';
import StatTile from '@/components/StatTile.vue';
import StreakCounter from '@/components/StreakCounter.vue';
import { Card, CardContent } from '@/components/ui/card';
import XpBar from '@/components/XpBar.vue';
import { demoAchievements, demoLeaderboard, demoQuests } from '@/lib/demoData';
import { dashboard } from '@/routes';

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Dashboard',
                href: dashboard(),
            },
        ],
    },
});

const player = {
    name: 'You',
    title: 'Rank #4 · Silver League',
    level: 12,
    xp: 340,
    xpToNext: 500,
    streak: 12,
};

const unlockedCount = demoAchievements.filter((a) => a.unlocked).length;
</script>

<template>
    <Head title="Dashboard" />

    <div
        class="flex h-full flex-1 flex-col gap-6 overflow-x-auto rounded-xl p-4"
    >
        <Card
            class="animate-in duration-500 fill-mode-both fade-in slide-in-from-bottom-2"
        >
            <CardContent
                class="flex flex-col gap-6 sm:flex-row sm:items-center"
            >
                <LevelBadge
                    :level="player.level"
                    :progress="(player.xp / player.xpToNext) * 100"
                    size="lg"
                />
                <div class="flex-1 space-y-2">
                    <div class="flex flex-wrap items-center gap-3">
                        <h1
                            class="font-display text-xl font-semibold text-foreground"
                        >
                            {{ player.name }}
                        </h1>
                        <StreakCounter :days="player.streak" />
                    </div>
                    <p class="text-sm text-muted-foreground">
                        {{ player.title }}
                    </p>
                    <XpBar
                        :current="player.xp"
                        :max="player.xpToNext"
                        label="Level progress"
                    />
                </div>
            </CardContent>
        </Card>

        <div
            class="grid animate-in grid-cols-2 gap-4 delay-75 duration-500 fill-mode-both fade-in slide-in-from-bottom-2 md:grid-cols-4"
        >
            <StatTile
                label="Total XP"
                value="24,180"
                :icon="Zap"
                :trend="{ value: 8, direction: 'up' }"
            />
            <StatTile
                label="Achievements"
                :value="`${unlockedCount}/${demoAchievements.length}`"
                :icon="Trophy"
            />
            <StatTile
                label="Current Rank"
                value="#4"
                :icon="Crown"
                :trend="{ value: 2, direction: 'up' }"
            />
            <StatTile
                label="Quests Completed"
                value="47"
                :icon="CheckCircle2"
            />
        </div>

        <div
            class="animate-in space-y-3 delay-150 duration-500 fill-mode-both fade-in slide-in-from-bottom-2"
        >
            <h2
                class="font-display text-sm font-semibold tracking-wide text-muted-foreground uppercase"
            >
                Achievements
            </h2>
            <AchievementGrid :achievements="demoAchievements" />
        </div>

        <div
            class="grid animate-in gap-6 delay-200 duration-500 fill-mode-both fade-in slide-in-from-bottom-2 lg:grid-cols-5"
        >
            <Card class="lg:col-span-3">
                <CardContent>
                    <h2
                        class="mb-4 font-display text-sm font-semibold tracking-wide text-muted-foreground uppercase"
                    >
                        Leaderboard
                    </h2>
                    <LeaderboardTable :entries="demoLeaderboard" />
                </CardContent>
            </Card>
            <Card class="lg:col-span-2">
                <CardContent>
                    <h2
                        class="mb-4 font-display text-sm font-semibold tracking-wide text-muted-foreground uppercase"
                    >
                        Quests
                    </h2>
                    <QuestList :quests="demoQuests" />
                </CardContent>
            </Card>
        </div>
    </div>
</template>
