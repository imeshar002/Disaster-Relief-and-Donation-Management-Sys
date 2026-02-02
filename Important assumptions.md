###### **Plan**

Here’s how we’ll proceed slowly and clearly. Since you want it minimally pleasing, we’ll use PHP + Bootstrap (CSS framework) for a simple but clean frontend that interacts with your MySQL database.


Step 1: Plan Your UI

We need simple forms for each table to do CRUD:

Donor → add donor, view donors, update donor, delete donor

Donation → add donation, view donation, update, delete

DonationItem → add donation item, etc.

Item

Beneficiary

Distribution

DistributionItem

Inventory

User

*Step 1a – Minimal UI:*

One page per table is fine.

Each page:

Add new record (form)

Table listing existing records with Edit/Delete buttons

You’ll use Bootstrap to make it look clean without too much work.

###### **Connection.php**

Not really necessary, and in fact in real projects you usually don’t show “connected successfully” to users.

Why?

It’s just a backend thing — the user doesn’t care about your database connection.

Showing it could look unprofessional.

###### **add donation.php**

Yes, showing raw DonorIDs publicly is not ideal. Normally, in a real system, only admins or authorized staff should have access to these dropdowns that link to internal IDs. For your course project, it’s fine because it’s a controlled environment—students aren’t going to misuse it—but it’s still better to show donor names instead of IDs, and let the system figure out the ID in the background.

Here’s the corrected version of your add\_donation.php with a dropdown that shows donor names but submits the ID, which solves your problem:

###### **explainable php code**
Yes, this code is totally explainable in viva. You can say something like:

“First, I connected to the database using mysqli. Then I fetched existing Donation and Item records so the user can select them from dropdowns instead of typing IDs manually. On form submission, I insert a new row into DonationItem with the selected DonationID, ItemID, and Quantity. I also show success or error messages using Bootstrap alerts.”

It’s straightforward and follows basic CRUD – the C (Create) part.

###### **seperate bootstrap files or one file?**
Yes, you can add the Bootstrap link in each file like we’ve been doing — it works fine and is the simplest way when you have just a few pages. For your project, that’s perfectly acceptable.

The “better” way, if you had a bigger system, is to use a separate header file (e.g., header.php) with the Bootstrap link and any common CSS/JS, and then include it in all pages with <?php include 'header.php'; ?>. That way, if you want to update Bootstrap version or styles, you only change it in one place.

For now, since you want to move fast and keep it simple, keeping it in each file is fine.

###### **What Phase 3 ACTUALLY expects (in simple words)**
Phase 3 is NOT:

❌ Full production system
❌ Authentication, security, role-based UI, advanced frontend

Phase 3 IS:
“Show that you can implement your ER model using SQL and interact with it practically.”

That means:

Tables exist ✅
Data can be inserted ✅
Data can be viewed (SELECT) ❗
Data can be updated/deleted (CRUD) ❗
Screenshots + report ❗

# Now you must show SELECT.
You need at least 2–3 view pages, not necessarily for all tables.

Example:
view_donor.php
view_donation.php
view_inventory.php

These pages:
Fetch data using SELECT
Display it in a table
Are used for screenshots in report
Are easy to explain in viva

👉 This alone already satisfies:“some sample queries including Select”

# You do NOT need CRUD for every table.

Minimum acceptable:
One table with DELETE
One table with UPDATE (optional but strong)

Best choice:
Donor (simple, no dependencies)

Example:
Delete a donor by clicking a button
Update donor name/contact

This satisfies:“CRUD operations”

# About FOREIGN KEYS (important reassurance)
You are 100% OK to leave FK constraints out.

Why?
Lecturer explicitly said: “don’t design table, write sql command”
You still logically enforce relationships via dropdowns
This is very common in DBMS coursework

In viva, you say:
“We didn’t enforce foreign keys physically to avoid insertion issues during testing, but logical relationships are maintained via controlled inputs.”

That’s a good answer, not a weak one.

# About USER / Admin / Staff confusion
You are thinking correctly, but don’t overcomplicate.
For THIS project:

User table = system users
Roles = Admin / Staff
You are NOT required to implement login / access control

So:
add_user.php = just demo that users can be stored
No need to “use” users anywhere else

If asked in viva:
“We focused on backend data modeling; authentication can be extended later.”

# How to explain veiw_donor.php in viva (memorize this)

“This page demonstrates the SELECT operation.
We retrieve donor records from the database using a SELECT query in PHP and display them in a table.
This satisfies the DML requirement and allows administrators to view stored data.”

That’s it. No overexplaining.

# How to protect yourself in viva (THIS IS IMPORTANT)-this is answer for doing sql in php files and not manually mostly

If an examiner asks:
“Did you use DML?”

You say (calmly):
“Yes. We used INSERT, SELECT, and DELETE queries.
Some were executed through phpMyAdmin for testing, and others were triggered via PHP forms as part of the UI.
In both cases, the database processes SQL DML commands.”

This answer:
Shows understanding
Covers both possibilities
Cannot be attacked

# phpMyAdmin SQL tab

Used for:
Testing queries
Creating tables
Inserting sample/test data

❌ Not how real applications work

PHP file with SQL inside
Used for:
Real users submitting forms
Dynamic data
Actual applications

When a user clicks Submit:
HTML Form → PHP → SQL → Databas

If they ask why PHP and not SQL tab:
“We use phpMyAdmin SQL for testing and table creation.
In the actual system, SQL is executed through PHP when users interact with the UI.
This shows real-world database usage.”

# why no crud for all entities answer
“Donation and distribution records are transactional data. In real systems, these are typically inserted and viewed, but not frequently updated or deleted, in order to preserve data integrity.
Therefore, full CRUD was not required for these entities within the project scope.”

“Full CRUD was implemented for core master entities such as Donor and Inventory, where updates and deletions are meaningful.”
If they ask directly:

“Why didn’t you implement update/delete for Donation?”
Your answer:
“Because Donation is a transactional record. Modifying or deleting such records can compromise historical accuracy and data integrity. Hence, we limited operations to insert and view.”

# view_inventory.php viva explain
If they ask: “What does this page do?”
“This page displays the current inventory status by retrieving data from the Inventory table and joining it with the Item table to show item names.”

If they ask: “Why JOIN Item table?”
“The Inventory table stores ItemID as a reference. To show meaningful information to the user, we join it with the Item table to display the item name instead of just an ID.”

That answer shows relational understanding.

If they ask: “What SQL operation is used here?”
“A SELECT query with a LEFT JOIN.”

If they ask: “Is this DML?”
“Yes. SELECT is part of DML, and here it is executed through the PHP frontend.”
# delete_donor.php  viva explain
If they ask: “How does this work?”
“We retrieve all donors from the database and let the user select which donor to delete. When submitted, a DELETE query runs on the backend.”

If they ask: “Why a dropdown instead of typing the ID?”
“To avoid mistakes and prevent the user from accidentally deleting the wrong donor. It also keeps it simple for non-technical users.”
# using dropdowns instead of tables with delete and add buttons
Professional enough: It looks clean and organized, especially for small CRUD forms.
Viva-safe: You can easily explain: “We use dropdowns to avoid users entering invalid IDs, ensuring data integrity.”
Functional: Reduces mistakes — no need to type IDs manually.
Simple to implement: Less work than making a fancy table with edit/delete buttons.
# “Why don’t you show items when updating a donation?”
Say this:
“Donation represents the donation event, while items are stored separately in the DonationItem table. To maintain normalization and data integrity, we handle item updates in a separate module.”
# why we delay adding foreign keys?
"We designed the database with foreign keys in mind, but applied them after validating the data flow and CRUD operations to avoid constraint issues during development.”
# “Why is the main page HTML and not PHP?”
“The dashboard is static and only provides navigation links, so HTML is sufficient. PHP is used only for backend operations involving the database.”
Why?
Your index page is only navigation, No database access, No PHP logic, Just links → HTML is perfect

PHP is only needed when: You talk to the database, You run SQL queries, You process forms, Your dashboard does none of that.
# Minimal screenshot list (safe pass)

If you want the shortest safe list, take screenshots of:

CREATE DATABASE
CREATE TABLE (5–6 tables)
SELECT validation before FK
ALTER TABLE ADD FOREIGN KEY
INSERT (2–3 tables)
SELECT * (2–3 tables)

# Minimal list of tables to screenshot (safe pass)
Do this for:

Donor
Donation
Item
Distribution
DistributionItem
# What NOT to worry about

phpMyAdmin config storage warning → irrelevant
Missing “Go” button → normal in newer versions
Not having original query history → normal
# donationItem table eken pahala polulated ss gnn bari una, including it