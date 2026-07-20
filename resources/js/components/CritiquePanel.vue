<script setup lang="ts">
import { ArrowRight, Check, CircleCheckBig, Wrench } from '@lucide/vue';
import { computed } from 'vue';
import { Card, CardContent } from '@/components/ui/card';

const props = defineProps<{
    score: number;
    passed: boolean;
    strengths: string[] | null;
    fixes: string[] | null;
    nextStep: string | null;
}>();

const strengths = computed(() => props.strengths ?? []);
const fixes = computed(() => props.fixes ?? []);
</script>

<template>
    <Card
        class="animate-in duration-300 fade-in slide-in-from-bottom-2"
        :class="passed ? 'glow-success border-success/40' : 'border-warning/40'"
    >
        <CardContent class="space-y-4">
            <div class="flex items-center justify-between gap-3">
                <div class="flex items-center gap-2">
                    <CircleCheckBig v-if="passed" class="size-5 text-success" />
                    <Wrench v-else class="size-5 text-warning" />
                    <p
                        class="font-display text-base font-semibold text-foreground"
                    >
                        {{ passed ? 'Client-ready' : 'Almost there' }}
                    </p>
                </div>
                <span
                    class="font-display text-lg font-bold"
                    :class="passed ? 'text-success' : 'text-warning'"
                >
                    {{ score
                    }}<span class="text-sm text-muted-foreground">/100</span>
                </span>
            </div>

            <div v-if="strengths.length" class="space-y-1.5">
                <p
                    class="text-xs font-medium tracking-wide text-muted-foreground uppercase"
                >
                    What's working
                </p>
                <div
                    v-for="(item, index) in strengths"
                    :key="`s-${index}`"
                    class="flex items-start gap-2 text-sm text-foreground"
                >
                    <Check class="mt-0.5 size-4 shrink-0 text-success" />
                    <span>{{ item }}</span>
                </div>
            </div>

            <div v-if="fixes.length" class="space-y-1.5">
                <p
                    class="text-xs font-medium tracking-wide text-muted-foreground uppercase"
                >
                    What to fix
                </p>
                <div
                    v-for="(item, index) in fixes"
                    :key="`f-${index}`"
                    class="flex items-start gap-2 text-sm text-muted-foreground"
                >
                    <Wrench class="mt-0.5 size-4 shrink-0 text-warning" />
                    <span>{{ item }}</span>
                </div>
            </div>

            <div
                v-if="nextStep"
                class="flex items-start gap-2 rounded-lg border border-primary/30 bg-primary/5 p-3 text-sm text-foreground"
            >
                <ArrowRight class="mt-0.5 size-4 shrink-0 text-primary" />
                <span>{{ nextStep }}</span>
            </div>
        </CardContent>
    </Card>
</template>
