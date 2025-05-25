declare namespace App.Data {
export type ExerciseData = {
id: number;
name: string;
category: string;
description: string | null;
};
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
declare namespace App.Enums {
export type FlashComponent = 'exercise-created' | 'exercise-updated';
}
