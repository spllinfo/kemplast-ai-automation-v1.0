// Function to generate various types of console logs
function generateConsoleLogs() {
    console.log("=== CONSOLE LOG GENERATOR ===");
    console.log("Simple log message");
    console.info("Info message with blue icon");
    console.warn("Warning message with yellow icon");
    console.error("Error message with red icon");

    // Log with styling
    console.log("%cStyled log message", "color: blue; font-size: 20px; font-weight: bold;");
    console.log("%cDanger!", "color: red; font-size: 50px; font-weight: bold;", "Something went wrong!");

    // Log objects and arrays
    console.log("Object example:", { id: 1, name: "Test Object", properties: ["prop1", "prop2"] });
    console.log("Array example:", [1, 2, 3, 4, 5]);

    // Table format
    console.table([
        { name: "Alice", age: 25, role: "Developer" },
        { name: "Bob", age: 32, role: "Designer" },
        { name: "Charlie", age: 28, role: "Manager" }
    ]);

    // Grouping logs
    console.group("Grouped Logs");
    console.log("This is inside a group");
    console.log("More information in the group");
    console.groupEnd();

    // Nested groups
    console.group("Main Group");
    console.log("Main group item 1");
    console.group("Nested Group");
    console.log("Nested item 1");
    console.log("Nested item 2");
    console.groupEnd();
    console.log("Main group item 2");
    console.groupEnd();

    // Timing
    console.time("Timer");
    // Simulate some work
    for (let i = 0; i < 1000000; i++) {
        // Do nothing, just loop
    }
    console.timeEnd("Timer");

    // Trace
    console.trace("Stack trace");

    console.log("=== END OF CONSOLE LOG GENERATOR ===");
}

// Call the function to generate logs
generateConsoleLogs();

// You can also call this function from the console later by typing:
// generateConsoleLogs();
