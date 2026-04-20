/**
 * Asynchronously computes the SHA-256 hash of a given string.
 *
 * @param {string} string - The input string to be hashed.
 * @returns {Promise<string>} A promise that resolves to the hexadecimal
 * representation of the SHA-256 hash.
 * @throws Will throw an error if the input is not a string.
 */

async function hash(string_data) {

  isString(string_data);

  const encoder = new TextEncoder();
  const data = encoder.encode(string_data);
  const hashBuffer = await crypto.subtle.digest('SHA-256', data);
  const hashArray = Array.from(new Uint8Array(hashBuffer));
  const hashHex = hashArray.map(b => b.toString(16).padStart(2, '0')).join('');

  return hashHex.toString();
}
