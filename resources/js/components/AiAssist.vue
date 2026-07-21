<script setup lang="ts">
import { Check, Copy, Sparkles } from '@lucide/vue';
import { ref } from 'vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';

const props = defineProps<{
    approach: string;
    prompt: string;
}>();

const copied = ref(false);
let resetTimer: ReturnType<typeof setTimeout> | undefined;

async function copyPrompt(): Promise<void> {
    try {
        await navigator.clipboard.writeText(props.prompt);
        copied.value = true;

        if (resetTimer !== undefined) {
            clearTimeout(resetTimer);
        }

        resetTimer = setTimeout(() => {
            copied.value = false;
        }, 2000);
    } catch {
        // Clipboard can be blocked (permissions, insecure context); fail quietly.
    }
}
</script>

<template>
    <Card class="border-primary/30">
        <CardContent class="space-y-3">
            <div class="flex items-center gap-2">
                <div
                    class="flex size-8 items-center justify-center rounded-lg bg-primary/10 text-primary"
                >
                    <Sparkles class="size-5" />
                </div>
                <h3
                    class="font-display text-base font-semibold text-foreground"
                >
                    Use AI on this
                </h3>
            </div>

            <p class="text-sm leading-relaxed text-muted-foreground">
                {{ approach }}
            </p>

            <div class="space-y-2">
                <div class="flex items-center justify-between">
                    <p
                        class="text-[11px] font-medium tracking-wide text-muted-foreground uppercase"
                    >
                        Starter prompt
                    </p>
                    <Button
                        variant="secondary"
                        size="sm"
                        class="h-7 gap-1.5 px-2"
                        @click="copyPrompt"
                    >
                        <component
                            :is="copied ? Check : Copy"
                            class="size-3.5"
                            :class="copied ? 'text-success' : ''"
                        />
                        {{ copied ? 'Copied' : 'Copy' }}
                    </Button>
                </div>
                <pre
                    class="overflow-x-auto rounded-lg border border-border bg-muted/40 p-3 font-mono text-xs leading-relaxed whitespace-pre-wrap text-muted-foreground"
                    >{{ prompt }}</pre>
            </div>
        </CardContent>
    </Card>
</template>
