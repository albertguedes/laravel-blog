/**
 * masks.js - Helper functions for input field masking
 *
 * @file
 */

/**
 * Masks the input field for CPF (Brazilian individual taxpayer registry) by adding
 * the format XXX.XXX.XXX-XX.
 *
 * @param {string} inputId - the id of the input field to be masked
 * @return {void}
 */
function maskCpf(inputId) {
  isString(inputId);

  // Select the input field with the provided id
  let $inputField = $('#' + inputId);

  // Add event listener for input
  $inputField.on('keyup change', function() {
    let cpf = $(this).val();

    // Remove any non-digit characters
    cpf = cpf.replace(/\D/g, "");

    // Limit to the maximum number of CPF digits (11)
    cpf = cpf.substring(0, 11);

    // Add the mask
    cpf = cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");

    // Update the input field value
    $(this).val(cpf);
  });
}

/**
 * Masks the input field for CNPJ (Brazilian company taxpayer registry) by adding
 * the format XX.XXX.XXX/XXXX-XX. The mask is maintained while the user is typing or erasing.
 *
 * @param {string} inputId - the id of the input field to be masked
 * @return {void}
 */
function maskCnpj(inputId) {
  // Select the input field with the provided id
  const $inputField = $('#' + inputId);

  // Add event listener for input
  $inputField.on('input', function() {
    let cnpj = $(this).val();

    // Remove any non-digit characters
    cnpj = cnpj.replace(/\D/g, "");

    // Limit to the maximum number of CNPJ digits (14)
    cnpj = cnpj.substring(0, 14);

    // Add the mask
    cnpj = cnpj.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5");

    // Update the input field value
    $(this).val(cnpj);
  });
}

/**
 * Masks the input field for phone DDD by limiting
 * to a maximum of 2 digits and only accepting numbers.
 *
 * @param {string} inputId - the id of the input field to be masked
 * @return {void}
 */
function maskPhoneDdd(inputId) {
  // Select the input field with the provided id
  const $inputField = $('#' + inputId);

  // Add event listener for input
  $inputField.on('input', function() {
    let ddd = $(this).val();

    // Remove any non-digit characters
    ddd = ddd.replace(/\D/g, "");

    // Limit to the maximum number of DDD digits (2)
    ddd = ddd.substring(0, 2);

    // Update the input field value
    $(this).val(ddd);
  });
}
/**
 * Masks the input field for phone number by adding
 * the format XXXX-XXXX or XXXXX-XXXX.
 *
 * @param {string} inputId - the id of the input field to be masked
 * @return {void}
 */
function maskPhoneNumber(inputId) {
  // Select the input field with the provided id
  const $inputField = $('#' + inputId);

  // Add event listener for input
  $inputField.on('input', function() {
      let phoneNumber = $(this).val();

      // Remove any non-digit characters
      phoneNumber = phoneNumber.replace(/\D/g, "");

      // Limit to the maximum number of phone digits (9)
      phoneNumber = phoneNumber.substring(0, 9);

      // Add the mask for 8 or 9 digits
      if (phoneNumber.length > 8) {
        phoneNumber = phoneNumber.replace(/(\d{5})(\d{4})/, "$1-$2");
      } else {
        phoneNumber = phoneNumber.replace(/(\d{4})(\d{4})/, "$1-$2");
      }

      // Update the input field value
      $(this).val(phoneNumber);
  });
}

/**
 * Forces the input field to allow only letters and convert them to lowercase.
 *
 * @param {string} inputId - the id of the input field to be modified
 * @return {void}
 */
function onlyLetters(inputId) {
  // Select the input field with the provided id
  const $inputField = $('#' + inputId);

  // Add event listener for input
  $inputField.on('input', function() {
    let text = $(this).val();

    // Remove any non-letter characters and convert to lowercase
    text = text.replace(/[^a-zA-Z]/g, "").toLowerCase();

    // Update the input field value
    $(this).val(text);
  });
}

/**
 * Forces the input field to convert all characters to lowercase.
 *
 * @param {string} inputId - the id of the input field to be modified
 * @return {void}
 */
function onlyLowerCase(inputId) {
  // Select the input field with the provided id
  const $inputField = $('#' + inputId);

  // Add event listener for input
  $inputField.on('input', function() {
    let text = $(this).val();

    // Convert to lowercase
    text = text.toLowerCase();

    // Update the input field value
    $(this).val(text);
  });
}
