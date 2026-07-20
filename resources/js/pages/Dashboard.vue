<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3';
import { CheckCircle2, Flame, Zap } from '@lucide/vue';
import { computed, onMounted } from 'vue';
import LevelBadge from '@/components/LevelBadge.vue';
import StatTile from '@/components/StatTile.vue';
import StreakCounter from '@/components/StreakCounter.vue';
import TrackMap from '@/components/TrackMap.vue';
import { Card, CardContent } from '@/components/ui/card';
import XpBar from '@/components/XpBar.vue';
import { notifyAchievementUnlocked } from '@/lib/rewardToast';
import { dashboard } from '@/routes';
import type { Celebration, TrackNode, TrackStats } from '@/types/tasks';

const props = defineProps<{
    nodes: TrackNode[];
    stats: TrackStats;
    celebration: Celebration | null;
}>();

defineOptions({
    layout: {
        breadcrumbs: [{ title: 'Track', href: dashboard() }],
    },
});

const page = usePage();
const progression = computed(() => page.props.progression);

const levelProgress = computed(() => {
    const p = progression.value;
    if (!p || p.xpForNextLevel === 0) {
        return 0;
    }
    return (p.xpIntoLevel / p.xpForNextLevel) * 100;
});

onMounted(() => {
    if (props.celebration) {
        notifyAchievementUnlocked({
            title: `Task passed: ${props.celebration.title}`,
            rarity: 'epic',
        });
    }
});
</script>

<template>
    <Head title="Your Track" />

    <div class="mx-auto flex w-full max-w-3xl flex-1 flex-col gap-6 p-4">
        <!-- Player header -->
        <Card
            class="animate-in duration-500 fill-mode-both fade-in slide-in-from-bottom-2"
        >
            <CardContent
                class="flex flex-col gap-6 sm:flex-row sm:items-center"
            >
                <LevelBadge
                    v-if="progression"
                    :level="progression.level"
                    :progress="levelProgress"
                    size="lg"
                />
                <div class="flex-1 space-y-2">
                    <div class="flex flex-wrap items-center gap-3">
                        <h1
                            class="font-display text-xl font-semibold text-foreground"
                        >
                            Your VA Track
                        </h1>
                        <StreakCounter
                            v-if="progression"
                            :days="progression.streak"
                        />
                    </div>
                    <p class="text-sm text-muted-foreground">
                        {{ stats.passed }} of {{ stats.total }} client scenarios
                        passed — keep going.
                    </p>
                    <XpBar
                        v-if="progression"
                        :current="progression.xpIntoLevel"
                        :max="progression.xpForNextLevel"
                        label="Level progress"
                    />
                </div>
            </CardContent>
        </Card>

        <!-- Stat row -->
        <div
            class="grid animate-in grid-cols-3 gap-4 delay-75 duration-500 fill-mode-both fade-in slide-in-from-bottom-2"
        >
            <StatTile
                label="Total XP"
                :value="progression?.xp ?? 0"
                :icon="Zap"
            />
            <StatTile
                label="Tasks passed"
                :value="`${stats.passed}/${stats.total}`"
                :icon="CheckCircle2"
            />
            <StatTile
                label="Day streak"
                :value="progression?.streak ?? 0"
                :icon="Flame"
            />
        </div>

        <!-- Track map -->
        <div
            class="animate-in space-y-3 delay-150 duration-500 fill-mode-both fade-in slide-in-from-bottom-2"
        >
            <h2
                class="font-display text-sm font-semibold tracking-wide text-muted-foreground uppercase"
            >
                Your journey
            </h2>
            <TrackMap :nodes="nodes" />
        </div>
    </div>
</template>
