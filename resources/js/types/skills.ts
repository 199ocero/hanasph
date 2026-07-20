export type CatalogCourse = {
    skillKey: string;
    title: string;
    icon: string | null;
    recommended: boolean;
};

export type IndexCourse = {
    skillKey: string;
    title: string;
    subtitle: string | null;
    icon: string | null;
    lessonCount: number;
    recommended: boolean;
    started: boolean;
    completed: boolean;
};

export type LessonState = 'passed' | 'current' | 'locked';

export type CourseLesson = {
    id: number;
    order: number;
    title: string;
    difficulty: string;
    xpReward: number;
    state: LessonState;
};

export type SubmissionFormat = 'text' | 'image' | 'file' | 'link';

export type SubmissionStatus = 'queued' | 'graded' | 'failed';

export type LessonSubmission = {
    id: number;
    status: SubmissionStatus;
    format: SubmissionFormat;
    bodyText: string | null;
    linkUrl: string | null;
    fileUrl: string | null;
    score: number | null;
    passed: boolean | null;
    strengths: string[] | null;
    fixes: string[] | null;
    nextStep: string | null;
};
