I need you to implement UI and functionality for all existing fields in the part management system based on the database migration. No new fields should be added - only implement fields that already exist in the migration.

Follow this structured approach:

1. DATABASE & MIGRATION ANALYSIS:
   - Examine the existing parts table migration
   - Identify ALL fields defined in the migration that need UI implementation
   - Do not modify any existing migrations

2. MODEL LAYER CONSISTENCY:
   - Ensure each migration field is properly included in the part model's $fillable array
   - Add any necessary accessors, mutators, or relationships for migration fields

3. FORM & UI INTEGRATION:
   - For each migration field not yet implemented in the UI:
     * Add appropriate input elements to #add_data_form with:
       - Input type matching the field's database type
       - Validation attributes (data-validate)
       - Label and placeholder text
       - Proper Bootstrap grid layout (consistent with existing fields)
     * Add identical field structure to #edit_data_form
     * Add field display to #viewDataModal following existing patterns

4. CONTROLLER & VALIDATION:
   - Update partController to handle all migration fields in store() and update() methods
   - Add appropriate validation rules for each field based on database constraints
   - Ensure all migration fields are included in edit/view API responses

5. JAVASCRIPT/AJAX IMPLEMENTATION:
   - Update form submission code to handle all migration fields
   - For each field, add logic to populate edit form:
     ```
     $("#field_name").val(response.field_name);
     ```
   - For each field, add code to display in view modal:
     ```
     $("#view_field_name").text(response.field_name);
     ```
   - Add special formatting logic for date, currency, or other special field types

6. DATA TABLE INTEGRATION:
   - Add relevant migration fields to the data table columns with proper sorting/filtering

Please maintain exact code style, naming conventions, and UI patterns as seen in the existing code. Remember, the goal is to completely implement ALL existing migration fields without modifying migrations themselves.
