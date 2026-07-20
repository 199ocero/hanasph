<script setup lang="ts">
import { TrendingDown, TrendingUp } from '@lucide/vue';
import type { Component } from 'vue';
import { Card, CardContent } from '@/components/ui/card';

type Props = {
    label: string;
    value: string | number;
    icon: Component;
    trend?: {
        value: number;
        direction: 'up' | 'down';
    };
};

defineProps<Props>();
</script>

<template>
    <Card class="gap-0 py-5">
        <CardContent class="flex items-start justify-between">
            <div class="space-y-1">
                <p class="text-sm text-muted-foreground">{{ label }}</p>
                <p class="font-display text-2xl font-semibold text-foreground">
                    {{ value }}
                </p>
                <p
                    v-if="trend"
                    class="flex items-center gap-1 text-xs font-medium"
                    :class="
                        trend.direction === 'up'
                            ? 'text-success'
                            : 'text-destructive'
                    "
                >
                    <component
                        :is="
                            trend.direction === 'up' ? TrendingUp : TrendingDown
                        "
                        class="size-3.5"
                    />
                    {{ trend.value }}%
                </p>
            </div>
            <div class="rounded-lg bg-primary/10 p-2.5 text-primary">
                <component :is="icon" class="size-5" />
            </div>
        </CardContent>
    </Card>
</template>
