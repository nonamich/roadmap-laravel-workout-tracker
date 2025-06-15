export type DashboardPageData = {
  schedules: any;
};
export type ExerciseData = {
  id: number;
  name: string;
  category: string;
  description: string | null;
};
export type ExerciseEditProps = {
  exercise: ExerciseData;
};
export type FlashComponent =
  | 'exercise-created'
  | 'exercise-updated'
  | 'workout-updated';
export type FlashMessageData = {
  props: any;
  component: FlashComponent | null;
  title: string | null;
};
export type NotificationData = {
  id: string;
  message: string;
  link: string;
  createdAt: any;
  readAt: any | null;
};
export type RecurrenceData = {
  id: number;
  name: string;
  weekdays: Array<number>;
  time: string;
};
export type RecurrenceStoreData = {
  id: number | null;
  name: string;
  weekdays: Array<any>;
  time: string;
};
export type ScheduleData = {
  id: number;
  scheduled_at: string;
  status: ScheduleStatus;
  workout: WorkoutData;
  recurrence: RecurrenceData | null;
};
export type ScheduleShowProps = {
  schedule: ScheduleData;
};
export type ScheduleStatus =
  | 'scheduled'
  | 'done'
  | 'wait-for-action'
  | 'missed';
export type ScheduleStoreData = {
  status: ScheduleStatus;
  workoutId: number;
  recurrenceId: number;
  userId: number;
  scheduledAt: any;
};
export type ShareData = {
  user: UserShareData | null;
  notifications: any;
  flash: FlashMessageData | string | null;
};
export type UserShareData = {
  id: number;
  name: string;
  email: string;
};
export type WorkoutCreateProps = {
  exercises: any;
};
export type WorkoutData = {
  id: number;
  title: string;
  description: string | null;
};
export type WorkoutEditExercisesProps = {
  exerciseId: number;
  sets: number;
  reps: number;
};
export type WorkoutEditProps = {
  workout: WorkoutData;
  workoutExercises: any;
  exercises: any;
  recurrences: any;
};
export type WorkoutShowProps = {
  workout: WorkoutData;
};
export type WorkoutStoreData = {
  id: number | null;
  title: string;
  description: string | null;
  exercises: Array<any>;
  recurrences: Array<any>;
};
export type WorkoutStoreExercisesData = {
  sets: number;
  reps: number;
  exerciseId: number;
};
