/**
 * dom.js - helper functions for DOM manipulation.
 *
 * @file
 */

/**
 * Sets the width of all elements with the given class name to the specified type of width.
 * @param {string} className - The class name to target.
 * @param {string} type - The type of width to set: 'min', 'max', or 'mean'.
 */
function setUniformWidth(className, type = 'max') {

    isString(className);

    isString(type);

    if (['min', 'max', 'mean'].indexOf(type) === -1) {
        throw new Error('type must be min, max or mean');
    }

    const elements = $(`.${className}`);

    if (!elements.length) {
        return;
    }

    const widths = elements.map((i, element) => $(element).width()).get();

    let targetWidth;

    switch (type) {
        case 'min':
            targetWidth = Math.min(...widths);
            break;
        case 'max':
            targetWidth = Math.max(...widths);
            break;
        case 'mean':
            targetWidth = widths.reduce((a, b) => a + b, 0) / widths.length;
            break;
        default:
            return;
    }

    elements.width(targetWidth);
}

/**
 * Sets the height of all elements with the given class name to the specified type of height.
 * @param {string} className - The class name to target.
 * @param {string} type - The type of height to set: 'min', 'max', or 'mean'.
 */
function setUniformHeight(className, type = 'max') {
    isString(className);

    isString(type);

    if (['min', 'max', 'mean'].indexOf(type) === -1) {
        throw new Error('type must be min, max or mean');
    }

    const elements = $('.' + className);
    const heights = elements.map(function () {
        return $(this).height();
    }).get();

    let targetHeight;
    switch (type) {
        case 'min':
            targetHeight = Math.min(...heights);
            break;
        case 'max':
            targetHeight = Math.max(...heights);
            break;
        case 'mean':
            targetHeight = heights.reduce((total, height) => total + height, 0) / heights.length;
            break;
        default:
            console.error('Invalid type: must be "min", "max", or "mean"');
            return;
    }

    elements.height(targetHeight);
}

/**
 * Sets the width and height of all elements with the given class name to the maximum width or height of elements with that class name.
 * @param {string} className - The class name to target.
 */
function sameHeightWidth(className, type = 'max') {

    isString(className);

    isString(type);

    if (['min', 'max', 'mean'].indexOf(type) === -1) {
        throw new Error('type must be min, max or mean');
    }

    var widths = [];
    var heights = [];

    $('.' + className).each(function () {
        widths.push($(this).width());
        heights.push($(this).height());
    });

    switch (type) {
        case 'min':
            var maxWidth = Math.max.apply(null, widths);
            var maxHeight = Math.max.apply(null, heights);
            var targetSize = Math.max(maxWidth, maxHeight);
            break;
        case 'max':
            var minWidth = Math.min.apply(null, widths);
            var minHeight = Math.min.apply(null, heights);
            var targetSize = Math.min(minWidth, minHeight);
            break;
        case 'mean':
            var meanHeight = heights.reduce((total, height) => total + height, 0) / heights.length;
            var meanWidth = widths.reduce((total, width) => total + width, 0) / widths.length;
            var targetSize = (meanHeight + meanWidth) / 2;
            break;
        default:
            console.error('Invalid type: must be "min", "max", or "mean"');
            return;
    }

    $('.' + className).width(targetSize);
    $('.' + className).height(targetSize);
}
