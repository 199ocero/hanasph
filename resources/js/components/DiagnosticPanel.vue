<script setup lang="ts">
import { AlertTriangle } from '@lucide/vue';

defineProps<{
    diagnostic: string;
}>();
</script>

<template>
    <div
        class="flex animate-in items-start gap-3 rounded-xl border border-destructive/40 bg-destructive/10 p-4 duration-300 fade-in slide-in-from-bottom-2"
    >
        <AlertTriangle class="mt-0.5 size-5 shrink-0 text-destructive" />
        <div class="space-y-1">
            <p class="font-display text-sm font-semibold text-foreground">
                Not quite
            </p>
            <p class="text-sm leading-relaxed text-muted-foreground">
                {{ diagnostic }}
            </p>
        </div>
    </div>
</template>
