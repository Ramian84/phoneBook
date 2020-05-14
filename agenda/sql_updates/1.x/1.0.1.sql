

ALTER TABLE `users` ADD `enabled` BOOLEAN NOT NULL DEFAULT FALSE AFTER `id`;

RENAME TABLE names TO contacts; 

RENAME TABLE addresses TO contact_addresses;
ALTER TABLE contact_addresses RENAME name_id TO contact_id;

RENAME TABLE phones TO contact_phones;
ALTER TABLE contact_phones RENAME name_id TO contact_id;  




