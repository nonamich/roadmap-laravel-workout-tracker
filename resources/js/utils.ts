export const timeToDate = (time: string) => {
  return new Date(`1970-01-01T${time}`);
};

export const getDayName = (day: number) => {
  const date = new Date(1970, 0, 4 + day);

  return new Intl.DateTimeFormat(navigator.language, {
    weekday: 'short',
  }).format(date);
};
