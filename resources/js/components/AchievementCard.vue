<script setup lang="ts">
import { Lock } from '@lucide/vue';
import { computed } from 'vue';
import { Card, CardContent } from '@/components/ui/card';
import {
    HoverCard,
    HoverCardContent,
    HoverCardTrigger,
} from '@/components/ui/hover-card';
import type { Achievement } from '@/types';

type Props = {
    achievement: Achievement;
};

const props = defineProps<Props>();

const rarityBorder = computed(
    () =>
        ({
            common: 'border-rarity-common/30',
            rare: 'border-rarity-rare/40',
            epic: 'border-rarity-epic/40',
            legendary: 'border-rarity-legendary/50',
        })[props.achievement.rarity],
);

const rarityText = computed(
    () =>
        ({
            common: 'text-rarity-common',
            rare: 'text-rarity-rare',
            epic: 'text-rarity-epic',
            legendary: 'text-rarity-legendary',
        })[props.achievement.rarity],
);

const rarityGlow = computed(() =>
    props.achievement.unlocked && props.achievement.rarity === 'legendary'
        ? 'glow-gold'
        : '',
);
</script>

<template>
    <HoverCard :open-delay="150">
        <HoverCardTrigger as-child>
            <Card
                class="gap-3 border py-4 transition-all duration-200 hover:-translate-y-0.5 hover:shadow-lg"
                :class="[
                    rarityBorder,
                    rarityGlow,
                    !achievement.unlocked && 'opacity-60',
                ]"
            >
                <CardContent
                    class="flex flex-col items-center gap-2 text-center"
                >
                    <div
                        class="flex size-12 items-center justify-center rounded-full bg-accent"
                        :class="rarityText"
                    >
                        <Lock
                            v-if="!achievement.unlocked"
                            class="size-5 text-muted-foreground"
                        />
                        <component
                            :is="achievement.icon"
                            v-else
                            class="size-5"
                        />
                    </div>
                    <p class="text-sm font-medium text-foreground">
                        {{ achievement.title }}
                    </p>
                    <p class="text-xs text-muted-foreground">
                        {{ achievement.description }}
                    </p>
                    <span
                        class="font-display text-[10px] font-semibold tracking-wide uppercase"
                        :class="rarityText"
                    >
                        {{ achievement.rarity }}
                    </span>
                </CardContent>
            </Card>
        </HoverCardTrigger>
        <HoverCardContent class="w-56 text-sm">
            <p class="font-medium text-foreground">{{ achievement.title }}</p>
            <p class="mt-1 text-xs text-muted-foreground">
                {{ achievement.description }}
            </p>
            <p class="mt-2 text-xs text-muted-foreground">
                <span v-if="achievement.unlocked && achievement.unlockedAt">
                    Unlocked {{ achievement.unlockedAt }}
                </span>
                <span v-else-if="!achievement.unlocked">Locked</span>
            </p>
        </HoverCardContent>
    </HoverCard>
</template>
