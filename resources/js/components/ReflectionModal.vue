<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { NotebookPen } from '@lucide/vue';
import ReflectionController from '@/actions/App/Http/Controllers/ReflectionController';
import { Button } from '@/components/ui/button';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog';
import { Textarea } from '@/components/ui/textarea';

const props = defineProps<{
    prompt: string;
    taskSlug: string;
}>();

const open = defineModel<boolean>('open', { required: true });

const form = useForm<{ note: string }>({ note: '' });

function submit(): void {
    if (form.note.trim().length === 0) {
        return;
    }

    form.post(ReflectionController.store.url({ task: props.taskSlug }), {
        preserveScroll: true,
        onSuccess: () => {
            open.value = false;
            form.reset();
        },
    });
}

function skip(): void {
    form.reset();
    open.value = false;
}
</script>

<template>
    <Dialog :open="open" @update:open="open = $event">
        <DialogContent
            class="animate-in duration-300 fade-in slide-in-from-bottom-2 sm:max-w-md"
        >
            <DialogHeader>
                <div class="flex items-center gap-2">
                    <div
                        class="flex size-8 shrink-0 items-center justify-center rounded-lg bg-primary/10 text-primary"
                    >
                        <NotebookPen class="size-5" />
                    </div>
                    <DialogTitle>Quick reflection</DialogTitle>
                </div>
                <DialogDescription>
                    {{ prompt }}
                </DialogDescription>
            </DialogHeader>

            <Textarea
                v-model="form.note"
                rows="3"
                placeholder="A sentence or two is plenty..."
                @keydown.meta.enter="submit"
                @keydown.ctrl.enter="submit"
            />

            <div class="flex justify-end gap-2">
                <Button variant="ghost" @click="skip">Skip</Button>
                <Button
                    :disabled="form.processing || form.note.trim().length === 0"
                    @click="submit"
                >
                    Save reflection
                </Button>
            </div>
        </DialogContent>
    </Dialog>
</template>
