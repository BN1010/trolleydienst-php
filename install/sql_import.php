<?php return '
INSERT INTO email_templates
VALUES (
	1,
	"Signature",
	"---
Deine Brüder

TEAM_NAME
APPLICATION_NAME CONGREGATION_NAME

Kontakt
E-Mail EMAIL_ADDRESS_REPLY
Webseite WEBSITE_LINK",
	 datetime("now", "localtime")
),
(
	2,
	"Infos",
	"Hallo NAME,

deine Nachricht

SIGNATURE",
	datetime("now", "localtime")
),
(
	3,
	"Neues Passwort",
	"Hallo NAME,

dein neues Passwort ist: PASSWORD

SIGNATURE",
	datetime("now", "localtime")
),
(
	4,
	"Neuer Bewerber",
	"Hallo NAME,

APPLICANT_NAME hat sich ebenfalls auf deine Schicht vom SHIFT_DATE beworben.

SIGNATURE",
	datetime("now", "localtime")
),
(
	5,
	"Bewerbung zurückgezogen",
	"Hallo NAME,

APPLICANT_NAME hat die Bewerbung auf deine Schicht vom SHIFT_DATE zurückgezogen.

SIGNATURE",
	datetime("now", "localtime")
),
(
	6,
	"Schicht gelöscht",
	"Hallo NAME,

deine Schicht vom SHIFT_DATE wurde gelöscht.

SIGNATURE",
	datetime("now", "localtime")
);
INSERT INTO shift_types
VALUES (
	1,
	"Trolley",
	3,
	"Das Predigen mit Trolleys — wie? https://wol.jw.org/de/wol/d/r10/lp-x/202015126",
	datetime("now", "localtime"),
	datetime("now", "localtime")
),
(
	2,
	"Infostand",
	3,
	"Das Predigen mit Infostand — wie? https://wol.jw.org/de/wol/d/r10/lp-x/202015126",
	datetime("now", "localtime"),
	datetime("now", "localtime")
)';