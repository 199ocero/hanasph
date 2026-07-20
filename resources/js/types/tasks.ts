export type TaskStatus = 'locked' | 'unlocked' | 'passed';

export type Progression = {
    level: number;
    xpIntoLevel: number;
    xpForNextLevel: number;
    xp: number;
    streak: number;
};

export type TrackNode = {
    order: number;
    slug: string;
    title: string;
    category: string;
    clientPersona: string;
    status: TaskStatus;
    isCurrent: boolean;
};

export type TrackStats = {
    total: number;
    passed: number;
};

export type Celebration = {
    title: string;
    xp: number;
};

export type PlayerOption = {
    id: number;
    order: number;
    body: string;
};

export type PlayerBeat = {
    id: number;
    order: number;
    clientMessage: string;
    scaffoldHint: string | null;
    tagalogTip: string | null;
    options: PlayerOption[];
};

export type PlayerTask = {
    slug: string;
    title: string;
    clientPersona: string;
    scenarioIntro: string;
    category: string;
    beatCount: number;
    aiGradingEnabled: boolean;
};

export type Lesson = { title: string; body: string };

/** Feedback from a multiple-choice attempt. */
export type McFeedback = {
    mode?: 'mc';
    correct: boolean;
    selectedOptionId: number;
    diagnostic: string | null;
    lesson: Lesson | null;
};

/** Feedback from an AI-graded free-text reply. */
export type AiFeedback = {
    mode: 'free_text';
    correct: boolean;
    score: number;
    feedback: string | null;
    suggestedReply: string | null;
    diagnostic: string | null;
    lesson: Lesson | null;
    graderUnavailable: boolean;
    rejected: boolean;
};

export type AttemptFeedback = McFeedback | AiFeedback;

export function isAiFeedback(
    feedback: AttemptFeedback | null,
): feedback is AiFeedback {
    return feedback?.mode === 'free_text';
}
