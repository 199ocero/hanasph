<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { FileUp, ImageUp, PencilLine } from '@lucide/vue';
import { computed, ref } from 'vue';
import { Button } from '@/components/ui/button';
import { Spinner } from '@/components/ui/spinner';
import type { SubmissionFormat } from '@/types/skills';

const props = defineProps<{
    acceptedFormats: SubmissionFormat[];
    submitUrl: string;
    disabled?: boolean;
}>();

const form = useForm<{
    format: SubmissionFormat;
    body_text: string;
    file: File | null;
}>({
    format: props.acceptedFormats[0],
    body_text: '',
    file: null,
});

const fileName = ref<string | null>(null);

const meta: Record<
    SubmissionFormat,
    { label: string; icon: unknown; accept: string }
> = {
    text: { label: 'Write', icon: PencilLine, accept: '' },
    image: { label: 'Upload image', icon: ImageUp, accept: 'image/*' },
    file: {
        label: 'Upload file',
        icon: FileUp,
        accept: '.pdf,.txt,.csv,.md,.doc,.docx,.xls,.xlsx',
    },
    link: { label: 'Link', icon: FileUp, accept: '' },
};

const canSubmit = computed(() => {
    if (props.disabled || form.processing) {
        return false;
    }

    return form.format === 'text'
        ? form.body_text.trim().length > 0
        : form.file !== null;
});

function pickFormat(format: SubmissionFormat): void {
    form.format = format;
    form.file = null;
    fileName.value = null;
}

function onFile(event: Event): void {
    const file = (event.target as HTMLInputElement).files?.[0] ?? null;
    form.file = file;
    fileName.value = file?.name ?? null;
}

function submit(): void {
    if (!canSubmit.value) {
        return;
    }

    form.post(props.submitUrl, { preserveScroll: true });
}
</script>

<template>
    <div class="space-y-3">
        <div v-if="acceptedFormats.length > 1" class="flex flex-wrap gap-2">
            <Button
                v-for="format in acceptedFormats"
                :key="format"
                type="button"
                size="sm"
                :variant="form.format === format ? 'secondary' : 'ghost'"
                @click="pickFormat(format)"
            >
                <component :is="meta[format].icon" class="size-4" />
                {{ meta[format].label }}
            </Button>
        </div>

        <textarea
            v-if="form.format === 'text'"
            v-model="form.body_text"
            :disabled="disabled || form.processing"
            rows="6"
            placeholder="Write your deliverable here…"
            class="min-h-36 w-full rounded-md border border-input bg-transparent px-3 py-2 text-sm text-foreground shadow-xs transition-[color,box-shadow] outline-none placeholder:text-muted-foreground focus-visible:border-ring focus-visible:ring-[3px] focus-visible:ring-ring/50 disabled:pointer-events-none disabled:opacity-50 dark:bg-input/30"
        />

        <label
            v-else
            class="flex cursor-pointer flex-col items-center justify-center gap-2 rounded-md border border-dashed border-input bg-transparent px-4 py-8 text-center text-sm text-muted-foreground transition-colors hover:border-ring dark:bg-input/30"
        >
            <component
                :is="meta[form.format].icon"
                class="size-6 text-primary"
            />
            <span v-if="fileName" class="font-medium text-foreground">{{
                fileName
            }}</span>
            <span v-else>Click to choose a {{ form.format }} to upload</span>
            <input
                type="file"
                class="hidden"
                :accept="meta[form.format].accept"
                :disabled="disabled || form.processing"
                @change="onFile"
            />
        </label>

        <p v-if="form.errors.body_text" class="text-sm text-destructive">
            {{ form.errors.body_text }}
        </p>
        <p v-if="form.errors.file" class="text-sm text-destructive">
            {{ form.errors.file }}
        </p>

        <Button
            type="button"
            size="lg"
            class="w-full"
            :disabled="!canSubmit"
            @click="submit"
        >
            <Spinner v-if="form.processing" />
            Submit for review
        </Button>
    </div>
</template>
