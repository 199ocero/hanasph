<script setup lang="ts">
import { Flame } from '@lucide/vue';
import { computed } from 'vue';

type Props = {
    days: number;
};

const props = defineProps<Props>();

const tier = computed(() => {
    if (props.days >= 30) {
        return 'text-gold';
    }

    if (props.days >= 7) {
        return 'text-warning';
    }

    return 'text-muted-foreground';
});

const isHot = computed(() => props.days >= 7);
</script>

<template>
    <div class="inline-flex items-center gap-1.5">
        <Flame class="size-5" :class="[tier, isHot && 'animate-flame']" />
        <span class="font-display text-lg font-semibold text-foreground">
            {{ days }}
        </span>
        <span class="text-sm text-muted-foreground">day streak</span>
    </div>
</template>
