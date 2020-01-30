CREATE TABLE Customer (
  UserId number NOT NULL,
  Firstname VARCHAR(32),
  Lastname VARCHAR(32),
  TelNr DECIMAL,
  CONSTRAINT pk_Customer PRIMARY KEY (UserId),
  check(TelNr<=9999999999)
);


CREATE TABLE Prime(
  UserId number NOT NULL,
  CONSTRAINT pk_Prime PRIMARY KEY (UserId)
);

ALTER TABLE Prime ADD CONSTRAINT fk_Prime_Customer FOREIGN KEY (UserId) REFERENCES Customer(UserId) on delete cascade;

CREATE TABLE Normal (
  UserId number NOT NULL,
  CONSTRAINT pk_Normal PRIMARY KEY (UserId)
);

ALTER TABLE Normal ADD CONSTRAINT fk_Normal_Customer FOREIGN KEY (UserId) REFERENCES Customer(UserId) on delete cascade;




CREATE TABLE Customer_orders (
  UserId number NOT NULL,
  ProductId number,
  OrderNr number NOT NULL unique,
  Order_date date default sysdate,
  CONSTRAINT pk_Customer_orders PRIMARY KEY (OrderNr,UserId)
);

ALTER TABLE Customer_orders ADD CONSTRAINT fk_Customer_orders_Customer FOREIGN KEY (UserId) REFERENCES Customer(UserId) on delete cascade;


CREATE TABLE Employee (
  EmployeeId number NOT NULL,
  Firstname VARCHAR(32),
  Lastname VARCHAR(32),
  TelNr number,
  CONSTRAINT pk_Employee PRIMARY KEY (EmployeeId)
);


CREATE TABLE supervise (
  EmployeeId number,
  CONSTRAINT pk_supervise PRIMARY KEY (EmployeeId)
);

ALTER TABLE supervise ADD CONSTRAINT fk_supervise_Employee FOREIGN KEY (EmployeeId) REFERENCES Employee(EmployeeId) on delete cascade;

CREATE TABLE delivers (
  EmployeeId number NOT NULL,
  SupplierId number NOT NULL,
  ProductId number not null,
  Delivery_date date default sysdate,
  CONSTRAINT pk_delivers PRIMARY KEY (EmployeeId,SupplierId,ProductId)
);

ALTER TABLE delivers ADD CONSTRAINT fk_delivers_Employee FOREIGN KEY (EmployeeId) REFERENCES Employee(EmployeeId) on delete cascade;

CREATE TABLE Product (
  ProductId number NOT NULL,
  Product_name VARCHAR(32),
  Brand VARCHAR(32),
  categorieId VARCHAR(32),
  Price number(30,2),
  CONSTRAINT pk_Product PRIMARY KEY (ProductId)
);
ALTER TABLE Customer_orders ADD CONSTRAINT fk_Customer_orders_Product FOREIGN KEY (ProductId) REFERENCES Product(ProductId) on delete cascade;

CREATE TABLE Supplier (
  SupplierId number NOT NULL,
  Supplier_name VARCHAR(32),
  TelNr decimal,
  CONSTRAINT pk_Supplier PRIMARY KEY (SupplierId)
);


ALTER TABLE delivers ADD CONSTRAINT fk_delivers_Supplier FOREIGN KEY (SupplierId) REFERENCES Supplier(SupplierId) on delete cascade;
ALTER TABLE delivers ADD CONSTRAINT fk_delivers_Product FOREIGN KEY (ProductId) REFERENCES Product(ProductId) on delete cascade;






--TRIGGERS

create sequence UserId_increase start with 1 increment by 1;
create or replace trigger Customer_trigger
before insert on Customer
for each row
begin
:new.UserId := UserId_increase.nextval;
end;
/

create sequence productid_increase start with 1 increment by 1;
create or replace trigger product_trigger
before insert on product
for each row
begin
:new.productid := productid_increase.nextval;
end;
/

create sequence OrderNr_increase start with 1 increment by 1;
create or replace trigger Customer_orders_trigger
before insert on Customer_orders
for each row
begin
:new.OrderNr := OrderNr_increase.nextval;
end;
/

create sequence EmployeeId_increase start with 1 increment by 1;
create or replace trigger Employee_trigger
before insert on Employee
for each row
begin
:new.EmployeeId := EmployeeId_increase.nextval;
end;
/



create sequence SupplierId_increase start with 1 increment by 1;
create or replace trigger Supplier_trigger
before insert on Supplier
for each row
BEGIN
:new.SupplierId := SupplierId_increase.nextval;
END;
/

CREATE OR REPLACE PROCEDURE price_change(n number)
IS
BEGIN
    UPDATE product set price = price + n;
END;
/

--INSERTS
insert into Customer (Firstname,Lastname,TelNr)
VALUES ('David', 'Alaba',10203040);
insert into Customer(Firstname,Lastname,telnr) VALUES
('Marko', 'Arnatovic',01020304);
INSERT INTO Customer(Firstname,Lastname,telnr) VALUES
('Aleksander', 'Dragovic',11223344);

insert into Prime values(1);
insert into Normal values (2);




insert into Supplier(Supplier_name,TelNr) values
('Saturn',12345678);



insert into product(Product_name,Brand,categorieId,Price)
values('S10','Samsung','Smart Phone',799);
insert into product(Product_name,Brand,categorieId,Price)
values('S10+','Samsung','Smart Phone',899);
insert into product(Product_name,Brand,categorieId,Price)
values('X','Apple','Smart Phone',899);
insert into product(Product_name,Brand,categorieId,Price)
values('XS','Apple','Smart Phone',999);


insert into Employee(Firstname,Lastname,TelNr)
values('Branko','Ivankovic',87654321);
insert into Employee(Firstname,Lastname,TelNr)
values('Jorgen','Klopp',8070605040);


insert into Customer_orders(UserId,ProductId)
values(1,1);
insert into Customer_orders(UserId,ProductId)
values(1,4);
insert into Customer_orders(UserId,ProductId)
values(2,3);
insert into Customer_orders(UserId,ProductId)
values(3,2);


insert into supervise VALUES(2);

DELETE FROM Customer WHERE UserId = 1;

UPDATE Customer
SET firstname = 'Alfred'
WHERE UserId = 2;

insert into delivers(EmployeeId,SupplierId,ProductId) VALUES(1,1,2);
insert into delivers(EmployeeId,SupplierId,ProductId) VALUES(1,1,3);

