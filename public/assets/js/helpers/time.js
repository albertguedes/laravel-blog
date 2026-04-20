/**
 * time.js - Helpers for working with time.
 *
 * @file
 */

/**
 * Time intervals in milliseconds.
 */
const SECOND_IN_MS = 1000;
const MINUTE_IN_MS = 60 * SECOND_IN_MS;
const HOUR_IN_MS = 60 * MINUTE_IN_MS;
const DAY_IN_MS = 24 * HOUR_IN_MS;
const WEEK_IN_MS = 7 * DAY_IN_MS;
const FORTNIGHT_IN_MS = 15 * DAY_IN_MS;
const MONTH_IN_MS = 30 * DAY_IN_MS;
const BIMESTER_IN_MS = 2 * MONTH_IN_MS;
const TRIMESTER_IN_MS = 3 * MONTH_IN_MS;
const SEMESTER_IN_MS = 6 * MONTH_IN_MS;
const YEAR_IN_MS = 365 * DAY_IN_MS;

// A list of intervals and periods names.
const INTERVALS_LIST = [
    'hour',
    'day',
    'week',
    'forthnight',
    'month',
    'bimester',
    'trimester',
    'semester',
    'year'
];
const PERIODS_LIST = [
    'hourly',
    'daily',
    'weekly',
    'fortnightly',
    'monthly',
    'bimesterly',
    'trimesterly',
    'semesterly',
    'yearly'
];

// A list of periods in milliseconds.
const PERIODS_IN_MS = {
  hourly: HOUR_IN_MS,
  daily: DAY_IN_MS,
  weekly: WEEK_IN_MS,
  fortnightly: FORTNIGHT_IN_MS,
  monthly: MONTH_IN_MS,
  bimesterly: BIMESTER_IN_MS,
  trimesterly: TRIMESTER_IN_MS,
  semesterly: SEMESTER_IN_MS,
  yearly: YEAR_IN_MS
};

/**
 * Converts a string period into a number of milliseconds.
 *
 * @param {string} periodName - The period name string.
 *
 * @returns {number} The number of milliseconds in the period.
 */
async function getPeriodInMs(periodName) {
  isString(periodName);
  return PERIODS_IN_MS[periodName] || (console.log('Invalid period: ' + periodName), undefined);
}

/**
 * Formats a Date object according to the given period.
 * Ex: a monthly period will return on the format '2019-01'.
 *
 * @param {string} stringDateTime - The Date object in string format.
 * @param {string} periodName - The period name string.
 *
 * @returns {string} The formatted date string.
 */
function formatPeriod(stringDateTime, periodName) {
  isString(stringDateTime);
  isString(periodName);

  switch (periodName) {
    case 'hourly':
      return stringDateTime.slice(0, 13) + 'h';

    case 'daily':
      return stringDateTime.slice(0, 10);

    case 'weekly':
      const date = new Date(stringDateTime);
      const weekOfMonth = Math.ceil((date.getDate() + date.getDay()) / 7);
      return stringDateTime.slice(0, 7) + ' w' + weekOfMonth;

    case 'monthly':
      return stringDateTime.slice(0, 7);

    case 'yearly':
      return stringDateTime.slice(0, 4);

    default:
      console.log('Invalid period: ' + period);
      return undefined;
  }
}

/**
 * Function to convert a given date and time object to UTC and format it to ISO
 * string. Ex: 2019-01-01T00:00:00.000Z
 *
 * @param {Date} dateTimeObject - The date and time object to convert.
 * @return {string} ISO formatted date and time string in UTC
 */
function convertToUTCAndISO(dateTimeObject) {
  isDate(dateTimeObject);
  const UTC_DATE = convertToUTC(dateTimeObject);
  return encodeURIComponent(UTC_DATE.toISOString());
}

/**
 * Function to convert a given date and time to UTC. Ex: 2019-01-01T00:00:00.000Z
 *
 * @param {Date} dateTimeObject - The date and time object to convert.
 * @return {Date} The date and time object in UTC
 */
function convertToUTC(dateTimeObject) {
  isDate(dateTimeObject);
  return new Date(Date.UTC(
    dateTimeObject.getUTCFullYear(),
    dateTimeObject.getUTCMonth(),
    dateTimeObject.getUTCDate(),
    dateTimeObject.getUTCHours(),
    dateTimeObject.getUTCMinutes(),
    dateTimeObject.getUTCSeconds(),
    dateTimeObject.getUTCMilliseconds()
  ));
}

/**
 * Function to convert a given timestamp in milliseconds to a string in ISO
 * format, normalized to UTC. Ex: 2019-01-01 00:00:00.000+00
 *
 * @param {number} timestamp - The timestamp in milliseconds to convert.
 * @return {string} The string representation of the timestamp in ISO format,
 *                  normalized to UTC.
 */
function normalizeUTC(timestamp) {
    isNumber(timestamp);
    let localDate = new Date(timestamp);

    return localDate.toISOString()
                    .slice(0, 19)
                    .replace('T', ' ') + '+00';
}

/**
 * Converts a Date object to ISO string format and cuts off the milliseconds.
 *
 * @param {Date} dateObject - The Date object to convert.
 * @return {string} The ISO formatted string without milliseconds.
 */
function toISOAndCutMs(dateObject) {
  isDate(dateObject);
  return dateObject.toISOString()
                    .split('.')[0];
}

function createIntervalFromStrings(begin, end) {
  isString(begin);
  isString(end);

  let b = new Date(begin);
  let e = new Date(end);

  return {
    begin: toISOAndCutMs(b),
    end: toISOAndCutMs(e)
  };
}


/**
 * Returns the begin and end time of the last time interval.
 *
 * @param {string} intervalName - The time interval, e.g. 'day' if you wish last day.
 * @return {object} An object with the begin and end time of the interval.
 */
function getLastInterval(intervalName) {

  isString(intervalName);

  const NOW = new Date();

  const NOW_UTC = new Date(Date.UTC(
    NOW.getUTCFullYear(),
    NOW.getUTCMonth(),
    NOW.getUTCDate(),
    23, 59, 59, 999
  ));

  // Time intervals in milliseconds.
  const NOW_IN_MS = NOW_UTC.getTime();

  let begin;
  switch (intervalName) {
    case 'day':
      begin = new Date(NOW_IN_MS - DAY_IN_MS);
      break;
    case 'week':
      begin = new Date(NOW_IN_MS - WEEK_IN_MS);
      break;
    case 'fortnight':
      begin = new Date(NOW_IN_MS - 15 * DAY_IN_MS);
      break;
    case 'month':
      begin = new Date(NOW_IN_MS - MONTH_IN_MS);
      break;
    case 'bimester':
      begin = new Date(NOW_IN_MS - 2 * MONTH_IN_MS);
      break;
    case 'trimester':
      begin = new Date(NOW_IN_MS - 3 * MONTH_IN_MS);
      break;
    case 'semester':
      begin = new Date(NOW_IN_MS - 6 * MONTH_IN_MS);
      break;
    case 'year':
      begin = new Date(NOW_IN_MS - YEAR_IN_MS);
      break;
    default:
      throw new Error('Invalid interval: ' + intervalName);
  }

  let end = NOW_UTC;

  return {
    begin: toISOAndCutMs(begin),
    end: toISOAndCutMs(end)
  };
}

/**
 * Returns the start and end time of today in ISO format.
 *
 * The start time is 00:00:00 and the end time is 23:59:59:999.
 *
 * @return {object} An object with the start and end time of today in ISO format.
 */
function getTodayInterval() {
  const NOW = new Date();

  const BEGIN = new Date(Date.UTC(
  NOW.getUTCFullYear(),
  NOW.getUTCMonth(),
  NOW.getUTCDate()
 ));

  const END = new Date(Date.UTC(
    NOW.getUTCFullYear(),
    NOW.getUTCMonth(),
    NOW.getUTCDate(),
    23, 59, 59, 999
  ));

  return {
    begin: toISOAndCutMs(BEGIN),
    end: toISOAndCutMs(END)
  }
}

/**
 * Checks if the given period is inside the given interval.
 *
 * The period is considered inside the interval if its index in the periods
 * array is less than the index of the interval in the intervals array.
 *
 * For example, if the period is 'hourly' and the interval is 'day', the
 * period is inside the interval since 'hourly' is at index 0 and 'day' is
 * at index 1.
 *
 * @param {string} periodName - The period name string.
 * @param {string} intervalName - The interval name string.
 *
 * @returns {boolean} True if the period is inside the interval, false
 *                    otherwise.
 */
function isPeriodInInterval(periodName, intervalName) {
     isString(periodName);
     isString(intervalName);

    const periodIndex = PERIODS_LIST.indexOf(period);
    if (periodIndex === -1) {
        throw new Error('Invalid period: ' + period);
    }

    const intervalIndex = INTERVALS_LIST.indexOf(interval);
    if (intervalIndex === -1) {
        throw new Error('Invalid interval: ' + interval);
    }

    return periodIndex <= intervalIndex;
}

function hasIntervalConflicts(interval) {
    return (interval.begin > interval.end) || (interval.end === interval.begin);
}

function showIntervalError(errorDisplay) {

    isObject(errorDisplay);

    const ERROR_MESSAGE = 'The start date must be before the end date';

    console.log(ERROR_MESSAGE);

    errorDisplay.text(ERROR_MESSAGE)
    .removeClass('d-none')
    .hide()
    .fadeIn();

    clearTimeout(window._erroTimeout);
    window._erroTimeout = setTimeout(() => {
        errorDisplay.fadeOut(() => {
            errorDisplay.addClass('d-none');
        });
    }, 5000);
}
