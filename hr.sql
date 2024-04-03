create table auto_sal (
id_s NUMBER(5) PRIMARY KEY,
city varchar(25),
street varchar2(25));

alter table auto_sal add CONSTRAINT chk_id_s check (id_s >= 10000 and id_s <= 99999);
alter table auto_sal add CONSTRAINT chk_city check (substr(city,1,1)>='�' and substr(city,1,1)<='�');
alter table auto_sal modify (city not null, street not null);

create table automob (
id_a number(10),
id_s number(5) references auto_sal(id_s),
mark_a varchar2(25),
country_a varchar2(25),
colour varchar2(25));

alter table automob add CONSTRAINT aut_pk primary key (id_a, id_s) enable;
alter table auto_sal modify (street varchar2(50));

create table renter (
id_renter number(5) primary key,
f_name varchar2(25) not null,
l_name varchar2(25) not null,
adress varchar2(100) not null,
tel varchar(15) not null);

alter table renter add CONSTRAINT chk_tel_len check (length(tel)>=12 and length(tel)<=15);
alter table renter add CONSTRAINT chk_tel_plus check (substr(tel,1,1)='+');
alter table renter add CONSTRAINT renter_pk primary key (id_renter) enable;

create table auto_rent (
id_a_rent number(5),
id_renter number(5),
id_a number(10),
id_s number(5),
date_beg varchar2(25) not null,
date_end varchar2(25) not NULL,
is_return varchar(25),
penalty varchar2(25));

alter table auto_rent add CONSTRAINT a_rent_pk primary key (id_a_rent, id_renter, id_a, id_s) enable;
alter table auto_rent add constraint id_s_fk foreign key (id_s) references auto_sal(id_s);
alter table auto_rent add constraint id_renter_fk foreign key (id_renter) references renter(id_renter);
alter table auto_rent add constraint id_a_fk foreign key (id_a, id_s) references automob(id_a,id_s);

insert into auto_sal values (10000,'���������','��. ��������������');
insert into auto_sal values (10001,'���������','��. ��������');
insert into auto_sal values (10002,'���������','��. ��������');
insert into auto_sal values (10003,'���������','��. �������');
insert into auto_sal values (58436,'���������','��. ���������');
select * from auto_sal;

insert into automob values (1,10001,'Lada','������','�����');
insert into automob values (1,10003,'Lada','������','������');
insert into automob values (1,10000,'BMW','��������','������');
insert into automob values (2,10000,'BMW','��������','�����');
insert into automob values (1,58436,'Lada','������','�����');

insert into renter values (1,'����','������','��������� ��. ��������','+74654364234');
insert into renter values (2,'����','������','��������� ��. ��������','+53423453534525');
insert into renter values (3,'�������','������','��������� ��. �������������','+74654364234');
insert into renter values (4,'����','������','��������� ��. �������','+45353452343465');
insert into renter values (5,'����','������','��������� ��. ���������','+45643563456546');

insert into auto_rent values (1,1,1,10001,'03.04.2024','03.05.2024','','');
insert into auto_rent values (2,1,2,10000,'03.04.2024','03.05.2024','','');
insert into auto_rent values (3,4,1,10003,'03.04.2024','03.05.2024','','');
insert into auto_rent values (4,2,1,58436,'03.04.2024','03.05.2024','','');
insert into auto_rent values (5,5,1,10001,'02.03.2024','02.04.2024','+','4000');