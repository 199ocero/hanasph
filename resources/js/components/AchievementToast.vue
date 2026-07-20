<script setup lang="ts">
import { Trophy } from '@lucide/vue';
import { computed } from 'vue';
import type { Rarity } from '@/types';

type Props = {
    title: string;
    rarity: Rarity;
};

const props = defineProps<Props>();

const rarityBorder = computed(
    () =>
        ({
            common: 'border-rarity-common',
            rare: 'border-rarity-rare',
            epic: 'border-rarity-epic',
            legendary: 'border-rarity-legendary',
        })[props.rarity],
);

const rarityText = computed(
    () =>
        ({
            common: 'text-rarity-common',
            rare: 'text-rarity-rare',
            epic: 'text-rarity-epic',
            legendary: 'text-rarity-legendary',
        })[props.rarity],
);

const rarityGlow = computed(() =>
    props.rarity === 'legendary' ? 'glow-gold' : 'glow-primary',
);
</script>

<template>
    <div
        class="flex w-full items-center gap-3 rounded-lg border-l-4 bg-popover p-4 shadow-lg"
        :class="[rarityBorder, rarityGlow]"
    >
        <div
            class="flex size-10 shrink-0 items-center justify-center rounded-full bg-accent"
            :class="rarityText"
        >
            <Trophy class="size-5" />
        </div>
        <div class="min-w-0">
            <p class="font-display text-sm font-semibold text-foreground">
                Achievement Unlocked!
            </p>
            <p class="truncate text-sm text-muted-foreground">{{ title }}</p>
        </div>
    </div>
</template>
