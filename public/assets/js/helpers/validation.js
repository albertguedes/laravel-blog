/**
 * validation.js - Validation helpers.
 *
 * @file
 */

/**
 * Verify if a given value is a string.
 *
 * @param {*} value - The value to verify.
 * @param {string} message - The message to display if the value is not valid.
 * @returns {boolean} True if the value is a string, false otherwise.
 */
function isString(value, message = '') {
  if(typeof message !== 'string') {
    throw new Error('message is not a string: ' + message + '.');
  }

  if(typeof value !== 'string') {
    throw new Error('value is not a string: ' + value + '.' + message);
  }

  if (value.trim() === '' || value === null) {
    throw new Error('value is empty or null.' + message);
  }
}

/**
 * Verify if a given value is not undefined, null or empty.
 *
 * @param {*} value - The value to verify.
 * @param {string} message - The message to display if the value is not valid.
 * @returns {boolean} True if the value is not undefined, null or empty, false otherwise.
 */
function isRequired(value, message = '') {

    if (message !== '') {
        isString(message);
    }

    if ((value !== undefined) || (value !== null) || (value !== '')) {
        throw new Error('value is required:' + value + '.' + message);
    }
}

/**
 * Verify if a given value is a Date object.
 *
 * @param {*} value - The value to verify.
 * @param {string} message - The message to display if the value is not valid.
 * @returns {boolean} True if the value is a Date object, false otherwise.
 */
function isDate(value, message = '') {

    if (message !== '') {
        isString(message);
    }

  if (!(value instanceof Date)) {
    throw new Error('value is not a Date object: ' + value + '.' + message);
  }
}

/**
 * Verify if a given value is a number.
 *
 * @param {*} value - The value to verify.
 * @param {string} message - The message to display if the value is not valid.
 * @returns {boolean} True if the value is a number, false otherwise.
 */
function isNumber(value, message = '') {

  if (message !== '') {
    isString(message);
  }

  if(typeof value !== "number") {
    throw new Error('value is not a number: ' + value + '.' + message);
  }
}

/**
 * Verify if a given value is an object.
 *
 * @param {*} value - The value to verify.
 * @param {string} message - The message to display if the value is not valid.
 * @returns {boolean} True if the value is an object, false otherwise.
 */
function isObject(value, message = '') {

  if (message !== '') {
    isString(message);
  }

  if ((typeof value !== 'object') || (value === null)) {
    throw new Error('value is not an object: ' + value + '.' + message);
  }
}

/**
 * Verify if a given value is an array.
 *
 * @param {*} value - The value to verify.
 * @param {string} message - The message to display if the value is not valid.
 * @throws {Error} If the value is not an array.
 */
function isArray(value, message = '') {

  if (message !== '') {
    isString(message);
  }

  if (!Array.isArray(value)) {
    throw new Error('value is not an array: ' + value + '.' + message);
  }
}

/**
 * Verify if a given response is ok.
 *
 * @param {Response} response - The response to verify.
 * @throws {Error} If the response is not ok.
 */
function isResponseOk(response) {
    if (!response.ok) {
        throw new Error(`Erro na requisição: ${response.status} ${response.statusText}`);
    }
}
