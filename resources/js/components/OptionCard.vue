<script setup lang="ts">
import { Check, X } from '@lucide/vue';
import { computed } from 'vue';
import { cn } from '@/lib/utils';
import type { PlayerOption } from '@/types/tasks';

const props = defineProps<{
    option: PlayerOption;
    selected: boolean;
    disabled: boolean;
    /** This option was the wrong pick that produced the current diagnostic. */
    wrong: boolean;
}>();

const emit = defineEmits<{
    select: [id: number];
}>();

const letter = computed(() => String.fromCharCode(64 + props.option.order));
</script>

<template>
    <button
        type="button"
        :disabled="disabled"
        :class="
            cn(
                'flex w-full items-start gap-3 rounded-xl border border-border bg-card p-4 text-left transition-all duration-200',
                !disabled &&
                    'hover:-translate-y-0.5 hover:border-primary/40 hover:shadow-lg',
                selected && !wrong && 'border-primary ring-1 ring-primary',
                wrong && 'border-destructive/60 bg-destructive/5 opacity-70',
                disabled && !wrong && 'opacity-55',
            )
        "
        @click="emit('select', option.id)"
    >
        <span
            :class="
                cn(
                    'flex size-7 shrink-0 items-center justify-center rounded-full border font-display text-xs font-semibold',
                    wrong
                        ? 'border-destructive/60 bg-destructive/10 text-destructive'
                        : selected
                          ? 'border-primary bg-primary text-primary-foreground'
                          : 'border-border bg-secondary text-muted-foreground',
                )
            "
        >
            <X v-if="wrong" class="size-4" />
            <Check v-else-if="selected" class="size-4" />
            <template v-else>{{ letter }}</template>
        </span>
        <span class="flex-1 text-sm leading-relaxed text-foreground">
            {{ option.body }}
        </span>
    </button>
</template>
