declare namespace App.Data {
export type FlashMessageData = {
props: any;
component: App.Enums.FlashComponent | null;
title: string | null;
};
export type ShareData = {
user: App.Data.UserShareData | null;
flash: App.Data.FlashMessageData | string | null;
};
export type UserShareData = {
id: number;
name: string;
email: string;
};
}
declare namespace App.Data.Exercises {
export type ExerciseData = {
id: number;
name: string;
category: string;
description: string | null;
};
}
declare namespace App.Data.Workouts {
export type WorkoutExercisesStoreData = {
sets: number;
reps: number;
exerciseId: number;
};
export type WorkoutSchedulesStoreData = {
name: string;
days: Array<number>;
time: string;
};
export type WorkoutStoreData = {
title: string;
description: string | null;
exercises: { [key: number]: App.Data.Workouts.WorkoutExercisesStoreData } | Array<any>;
schedules: { [key: number]: App.Data.Workouts.WorkoutSchedulesStoreData } | Array<any>;
};
}
declare namespace App.Enums {
export type FlashComponent = 'exercise-created' | 'exercise-updated';
}
