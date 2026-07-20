<script setup lang="ts">
import { Wand2 } from '@lucide/vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';

defineProps<{
    reply: string;
}>();

const emit = defineEmits<{
    use: [reply: string];
}>();
</script>

<template>
    <Card
        class="animate-in border-primary/30 duration-300 fade-in slide-in-from-bottom-2"
    >
        <CardContent class="space-y-3">
            <div class="flex items-center gap-2">
                <div
                    class="flex size-8 items-center justify-center rounded-lg bg-primary/10 text-primary"
                >
                    <Wand2 class="size-5" />
                </div>
                <h3
                    class="font-display text-base font-semibold text-foreground"
                >
                    A stronger version
                </h3>
            </div>

            <p
                class="rounded-lg border border-border bg-muted/40 p-3 text-sm leading-relaxed text-muted-foreground italic"
            >
                {{ reply }}
            </p>

            <Button
                variant="secondary"
                size="sm"
                class="w-full"
                @click="emit('use', reply)"
            >
                Use as a starting point
            </Button>
        </CardContent>
    </Card>
</template>
