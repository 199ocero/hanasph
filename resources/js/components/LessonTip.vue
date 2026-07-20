<script setup lang="ts">
import { Lightbulb } from '@lucide/vue';

defineProps<{
    tip: string;
}>();
</script>

<template>
    <div
        class="flex items-start gap-2.5 rounded-lg border border-primary/20 bg-primary/5 px-3 py-2.5"
    >
        <Lightbulb class="mt-0.5 size-4 shrink-0 text-primary" />
        <div class="min-w-0 flex-1 space-y-0.5">
            <p
                class="text-[11px] font-medium tracking-wide text-primary uppercase"
            >
                Tip
            </p>
            <p class="text-sm leading-relaxed text-muted-foreground">
                {{ tip }}
            </p>
        </div>
    </div>
</template>
