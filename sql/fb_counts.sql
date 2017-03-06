/* Basic table to persist fan counts */
CREATE TABLE `fb_fans` (
  `page_id` varchar(32) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fan_count` bigint(20) unsigned NOT NULL,
  KEY `page_id` (`page_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;