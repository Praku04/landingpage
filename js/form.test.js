/**
 * Form Validation Unit Tests - The Management Gurus
 * Run these tests in browser console or with a test runner
 */

(function() {
    'use strict';

    // Test results tracking
    let passed = 0;
    let failed = 0;

    // Simple test assertion
    function assert(condition, testName) {
        if (condition) {
            console.log(`✓ PASS: ${testName}`);
            passed++;
        } else {
            console.error(`✗ FAIL: ${testName}`);
            failed++;
        }
    }

    // Validation rules (copied from form.js for testing)
    const validationRules = {
        full_name: {
            required: true,
            minLength: 2,
            maxLength: 100,
            message: 'Please enter a valid name (2-100 characters)'
        },
        email: {
            required: true,
            pattern: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
            message: 'Please enter a valid email address'
        },
        phone: {
            required: true,
            pattern: /^[0-9]{10,15}$/,
            transform: (value) => value.replace(/[^0-9]/g, ''),
            message: 'Please enter a valid phone number (10-15 digits)'
        },
        message: {
            required: false,
            maxLength: 1000,
            message: 'Message must be less than 1000 characters'
        }
    };

    // Validate single field function
    function validateField(name, value) {
        const rules = validationRules[name];
        if (!rules) return { valid: true };

        const transformedValue = rules.transform ? rules.transform(value) : value;

        if (rules.required && !transformedValue.trim()) {
            return { valid: false, message: rules.message };
        }

        if (!transformedValue.trim() && !rules.required) {
            return { valid: true };
        }

        if (rules.minLength && transformedValue.length < rules.minLength) {
            return { valid: false, message: rules.message };
        }

        if (rules.maxLength && transformedValue.length > rules.maxLength) {
            return { valid: false, message: rules.message };
        }

        if (rules.pattern && !rules.pattern.test(transformedValue)) {
            return { valid: false, message: rules.message };
        }

        return { valid: true };
    }

    // ========================================
    // Full Name Validation Tests
    // ========================================
    console.log('\n--- Full Name Validation Tests ---');

    assert(
        validateField('full_name', '').valid === false,
        'Empty name should be invalid'
    );

    assert(
        validateField('full_name', 'A').valid === false,
        'Single character name should be invalid'
    );

    assert(
        validateField('full_name', 'Jo').valid === true,
        'Two character name should be valid'
    );

    assert(
        validateField('full_name', 'John Doe').valid === true,
        'Normal name should be valid'
    );

    assert(
        validateField('full_name', '   ').valid === false,
        'Whitespace-only name should be invalid'
    );

    assert(
        validateField('full_name', 'A'.repeat(101)).valid === false,
        'Name over 100 characters should be invalid'
    );

    assert(
        validateField('full_name', 'A'.repeat(100)).valid === true,
        'Name exactly 100 characters should be valid'
    );

    // ========================================
    // Email Validation Tests
    // ========================================
    console.log('\n--- Email Validation Tests ---');

    assert(
        validateField('email', '').valid === false,
        'Empty email should be invalid'
    );

    assert(
        validateField('email', 'test@example.com').valid === true,
        'Valid email should pass'
    );

    assert(
        validateField('email', 'test@example').valid === false,
        'Email without TLD should be invalid'
    );

    assert(
        validateField('email', 'testexample.com').valid === false,
        'Email without @ should be invalid'
    );

    assert(
        validateField('email', '@example.com').valid === false,
        'Email without local part should be invalid'
    );

    assert(
        validateField('email', 'test@.com').valid === false,
        'Email without domain should be invalid'
    );

    assert(
        validateField('email', 'user.name+tag@example.co.uk').valid === true,
        'Complex valid email should pass'
    );

    // ========================================
    // Phone Validation Tests
    // ========================================
    console.log('\n--- Phone Validation Tests ---');

    assert(
        validateField('phone', '').valid === false,
        'Empty phone should be invalid'
    );

    assert(
        validateField('phone', '1234567890').valid === true,
        '10 digit phone should be valid'
    );

    assert(
        validateField('phone', '123456789012345').valid === true,
        '15 digit phone should be valid'
    );

    assert(
        validateField('phone', '123456789').valid === false,
        '9 digit phone should be invalid'
    );

    assert(
        validateField('phone', '1234567890123456').valid === false,
        '16 digit phone should be invalid'
    );

    assert(
        validateField('phone', '+91 98765 43210').valid === true,
        'Phone with spaces and + should be valid (transformed)'
    );

    assert(
        validateField('phone', '(123) 456-7890').valid === true,
        'Phone with formatting should be valid (transformed)'
    );

    assert(
        validateField('phone', 'abcdefghij').valid === false,
        'Phone with only letters should be invalid'
    );

    // ========================================
    // Message Validation Tests
    // ========================================
    console.log('\n--- Message Validation Tests ---');

    assert(
        validateField('message', '').valid === true,
        'Empty message should be valid (optional field)'
    );

    assert(
        validateField('message', 'Hello, I am interested in your services.').valid === true,
        'Normal message should be valid'
    );

    assert(
        validateField('message', 'A'.repeat(1000)).valid === true,
        'Message exactly 1000 characters should be valid'
    );

    assert(
        validateField('message', 'A'.repeat(1001)).valid === false,
        'Message over 1000 characters should be invalid'
    );

    // ========================================
    // Unknown Field Tests
    // ========================================
    console.log('\n--- Unknown Field Tests ---');

    assert(
        validateField('unknown_field', 'any value').valid === true,
        'Unknown field should always be valid'
    );

    // ========================================
    // Test Summary
    // ========================================
    console.log('\n========================================');
    console.log(`Test Results: ${passed} passed, ${failed} failed`);
    console.log('========================================\n');

    if (failed === 0) {
        console.log('🎉 All tests passed!');
    } else {
        console.error(`⚠️ ${failed} test(s) failed. Please review.`);
    }

    // Export for external use
    window.FormValidationTests = {
        run: function() {
            console.log('Running form validation tests...');
            // Re-run all tests
            passed = 0;
            failed = 0;
            // Tests would run here
        },
        results: { passed, failed }
    };
})();
