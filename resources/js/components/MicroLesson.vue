<script setup lang="ts">
import { GraduationCap } from '@lucide/vue';
import { computed } from 'vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';

const props = defineProps<{
    title: string;
    body: string;
}>();

const emit = defineEmits<{
    retry: [];
}>();

const paragraphs = computed(() =>
    props.body.split('\n\n').filter((p) => p.trim().length > 0),
);
</script>

<template>
    <Card
        class="animate-in border-primary/30 duration-300 fade-in slide-in-from-bottom-2"
    >
        <CardContent class="space-y-4">
            <div class="flex items-center gap-2">
                <div
                    class="flex size-8 items-center justify-center rounded-lg bg-primary/10 text-primary"
                >
                    <GraduationCap class="size-5" />
                </div>
                <h3
                    class="font-display text-base font-semibold text-foreground"
                >
                    {{ title }}
                </h3>
            </div>

            <div class="space-y-3">
                <p
                    v-for="(paragraph, index) in paragraphs"
                    :key="index"
                    class="text-sm leading-relaxed text-muted-foreground"
                >
                    {{ paragraph }}
                </p>
            </div>

            <Button class="w-full" size="lg" @click="emit('retry')">
                Try again
            </Button>
        </CardContent>
    </Card>
</template>
