export type DashboardPageWebData = {
  schedules: any;
};
export type ExerciseEditProps = {
  exercise: ExerciseWebData;
};
export type ExerciseWebData = {
  id: number;
  name: string;
  category: string;
  description: string | null;
};
export type FlashComponent =
  | 'exercise-created'
  | 'exercise-updated'
  | 'workout-updated';
export type FlashMessageWebData = {
  props: any;
  component: FlashComponent | null;
  title: string | null;
};
export type NotificationWebData = {
  id: string;
  message: string;
  link: string;
  createdAt: any;
  readAt: any | null;
};
export type RecurrenceStoreWebData = {
  id: number | null;
  name: string;
  weekdays: Array<any>;
  time: string;
};
export type RecurrenceWebData = {
  id: number;
  name: string;
  weekdays: Array<number>;
  time: string;
};
export type ScheduleShowProps = {
  schedule: ScheduleWebData;
};
export type ScheduleStatus =
  | 'scheduled'
  | 'done'
  | 'wait-for-action'
  | 'missed';
export type ScheduleWebData = {
  id: number;
  scheduled_at: string;
  status: ScheduleStatus;
  workout: WorkoutWebData;
  recurrence: RecurrenceWebData | null;
};
export type ShareWebData = {
  user: UserShareWebData | null;
  notifications: any;
  flash: FlashMessageWebData | string | null;
};
export type UserShareWebData = {
  id: number;
  name: string;
  email: string;
};
export type WorkoutCreateProps = {
  exercises: any;
};
export type WorkoutEditExercisesProps = {
  exerciseId: number;
  sets: number;
  reps: number;
};
export type WorkoutEditProps = {
  workout: WorkoutWebData;
  workoutExercises: any;
  exercises: any;
  recurrences: any;
};
export type WorkoutShowProps = {
  workout: WorkoutWebData;
};
export type WorkoutStoreExercisesWebData = {
  sets: number;
  reps: number;
  exerciseId: number;
};
export type WorkoutStoreWebData = {
  id: number | null;
  title: string;
  description: string | null;
  exercises: Array<any>;
  recurrences: Array<any>;
};
export type WorkoutWebData = {
  id: number;
  title: string;
  description: string | null;
};
