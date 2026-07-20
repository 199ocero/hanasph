<script setup lang="ts">
import { Lightbulb, User } from '@lucide/vue';

defineProps<{
    persona: string;
    message: string;
    scaffoldHint?: string | null;
}>();
</script>

<template>
    <div class="space-y-3">
        <div class="flex items-start gap-3">
            <div
                class="flex size-9 shrink-0 items-center justify-center rounded-full bg-secondary text-muted-foreground"
            >
                <User class="size-5" />
            </div>
            <div class="min-w-0 flex-1">
                <p class="mb-1 text-xs font-medium text-muted-foreground">
                    {{ persona }}
                </p>
                <div
                    class="rounded-2xl rounded-tl-sm border border-border bg-card px-4 py-3 text-sm leading-relaxed whitespace-pre-line text-foreground"
                >
                    {{ message }}
                </div>
            </div>
        </div>

        <div
            v-if="scaffoldHint"
            class="ml-12 flex items-start gap-2 rounded-lg border border-warning/25 bg-warning/10 px-3 py-2 text-xs text-warning-foreground/90"
        >
            <Lightbulb class="mt-0.5 size-4 shrink-0 text-warning" />
            <span class="text-muted-foreground">{{ scaffoldHint }}</span>
        </div>
    </div>
</template>
