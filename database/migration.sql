CREATE database fan_count;

create table if not exists company (
	id INT(11) UNSIGNED NOT NULL,
	name varchar(110) NOT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	primary key (id)
);

create table if not exists fan_count (
    id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    fb_page_id INT(11) UNSIGNED NOT NULL,
    fan_count BIGINT NOT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    primary key (id),
    foreign key (fb_page_id) REFERENCES company (id)
);

