<script setup lang="ts">
import { Sparkles } from '@lucide/vue';
import { computed, ref } from 'vue';
import { Button } from '@/components/ui/button';
import XpBar from '@/components/XpBar.vue';
import { notifyAchievementUnlocked } from '@/lib/rewardToast';
import type { Quest } from '@/types';

type Props = {
    quest: Quest;
};

const props = defineProps<Props>();

const claimed = ref(props.quest.claimed);
const isComplete = computed(() => props.quest.current >= props.quest.max);

function claim() {
    if (!isComplete.value || claimed.value) {
        return;
    }

    claimed.value = true;

    notifyAchievementUnlocked({
        title: props.quest.title,
        rarity: 'rare',
    });
}
</script>

<template>
    <div
        class="flex flex-col gap-3 rounded-lg border border-border p-4 sm:flex-row sm:items-center sm:justify-between"
    >
        <div class="flex-1 space-y-2">
            <div class="flex items-center justify-between gap-2">
                <p class="text-sm font-medium text-foreground">
                    {{ quest.title }}
                </p>
                <span
                    class="inline-flex shrink-0 items-center gap-1 text-xs font-medium text-gold"
                >
                    <Sparkles class="size-3.5" />
                    {{ quest.xpReward }} XP
                </span>
            </div>
            <p class="text-xs text-muted-foreground">{{ quest.description }}</p>
            <XpBar :current="quest.current" :max="quest.max" />
        </div>
        <Button
            size="sm"
            :variant="claimed ? 'secondary' : 'default'"
            :disabled="!isComplete || claimed"
            class="sm:self-start"
            :class="isComplete && !claimed && 'animate-glow-primary'"
            @click="claim"
        >
            {{ claimed ? 'Claimed' : 'Claim' }}
        </Button>
    </div>
</template>
