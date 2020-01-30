package dbs;


import java.util.*;
import java.sql.*;
import oracle.jdbc.driver.*;
import java.util.Random;
public class TestdataGenerator {
	public static void main(String[] args)throws ClassNotFoundException, SQLException {	  
		//connect info
		Class.forName("oracle.jdbc.driver.OracleDriver");
		String database = "jdbc:oracle:thin:@oracle-lab.cs.univie.ac.at:1521:lab";
		String user = "a01428941";
		String pass = "dbs19";
		Connection con = DriverManager.getConnection(database , user, pass);
	    Statement stmt = con.createStatement();
	    //connection to Oracle Database Started
	    
	    String[] Firstname = {"'Max'","'Philipp'","'Luke'","'John'","'Mohammad'","'Ali'",
	    		"'Lionel'","'Cristiano'","'Luis'","'Natalia'","'Gabriel'","'Stefanie'",
	    		"'Mia'","'Selena'","'Nicole'","'Nick'","'Ellie'","'Emma'","'Olivia'","'Sophia'"};
	    String[] Lastname = {"'Smith'","'Jones'","'Williams'","'Brown'","'Davis'","'Miller'",
	    		"'Willson'","'Schneider'","'Fischer'","'Weber'","'Wagner'","'Meyer'",
	    		"'Koch'","'Richter'","'Klein'","'Beck'","'Huber'","'Fuchs'","'Jung'","'Rivera'"};
	    String[] Product_name= {"'p1'","'p2'","'p3'","'p4'","'p5'","'p6'","'p7'","'p8'","'p9'","'p10'"
	    		,"'p11'","'p12'","'p13'","'p14'","'p15'","'p16'","'p17'","'p18'","'p19'","'p20'"};
	    String[] Brand= {"'Samsung'","'Apple'","'Sony'","'Huawei'","'Microsoft'","'Lenovo'","'Asus'"
	    		,"'Panasonic'","'Nintendo'","'HTC'"};
	    String[] CategorieId= {"'Smart Phone'","'Smart Watch'","'TV'","'Console'","'Laptop'","'Speaker'"
	    		,"'Tablet'","'VR'","'Gift Card'","'Printer'"};
	    String[] Supplier_name= {"'Saturn'","'Mediamarkt'","'Amazon'","'Digikala'","'Apple Store'","'T-Mobile'"
	    		,"'A1'","'3'","'Hofer'","'Libro'"};
        
	    
	    int counter = 0;
	    
	    //Customer insert
	    while(counter < 1000) {
	    	Random rn = new Random();
            int fR = rn.nextInt(19) + 1;
            int lR = rn.nextInt(19) + 1;
            try {
            	Random tel = new Random();
            	int telNr = tel.nextInt(999999999-100000000) + 100000000;
            	String insertSQL = "insert into Customer (Firstname,Lastname,TelNr)"+
            			" Values("+Firstname[fR]+","+Lastname[lR]+","+telNr+")";
            	stmt.execute(insertSQL);
            }catch(Exception e) {
            	 System.err.println("Error by adding customer data: " + e.getMessage());
            }
            counter++;
	    }
	    
	    
	    
	    //Product insert
	    counter = 0;
	    while(counter < 100) {
	    	Random rn = new Random();
            int pnR = rn.nextInt(9) + 1;
            int bR = rn.nextInt(9) + 1;
            int cR = rn.nextInt(9) + 1;
            try {
            	Random pr = new Random();
            	int price = pr.nextInt(9999-1) + 1;
            	String insertSQL = "insert into product(Product_name,Brand,categorieId,Price)"+
            			" Values("+Product_name[pnR]+","+Brand[bR]+","+CategorieId[cR]+","+price+")";
            	stmt.execute(insertSQL);
            }catch(Exception e) {
            	 System.err.println("Error by adding customer data: " + e.getMessage());
            }
            counter++;
	    }
	    //Insert Employee
	    counter = 0;
	    while(counter < 100) {
	    	Random rn = new Random();
            int fR = rn.nextInt(19) + 1;
            int lR = rn.nextInt(19) + 1;
            try {
            	Random tel = new Random();
            	int telNr = tel.nextInt(999999999-100000000) + 100000000;
            	String insertSQL = "insert into Employee (Firstname,Lastname,TelNr)"+
            			" Values("+Firstname[fR]+","+Lastname[lR]+","+telNr+")";
            	stmt.execute(insertSQL);
            }catch(Exception e) {
            	 System.err.println("Error by adding customer data: " + e.getMessage());
            }
            counter++;
	    }
	    
	    //Insert Supplier
	    counter = 0;
	    while(counter < 100) {
	    	Random rn = new Random();
            int snR = rn.nextInt(9) + 1;
            try {
            	Random tel = new Random();
            	int telNr = tel.nextInt(999999999-100000000) + 100000000;
            	String insertSQL = "insert into Supplier(Supplier_name,TelNr)"+
            			" Values("+Supplier_name[snR]+","+telNr+")";
            	stmt.execute(insertSQL);
            	
            }catch(Exception e) {
            	 System.err.println("Error by adding Supplier data: " + e.getMessage());
            }
            counter++;
	    }
	    
	    /////////////////////////////////////
	    List<Integer> list = new ArrayList<>();
	    ResultSet custId = stmt.executeQuery("SELECT UserId From Customer");
	    while (custId.next()) {
	    	list.add(custId.getInt(1));
	    }

	    for (Integer integer : list) {
	    	String insertSQL = "insert into Prime (UserId)" +
	    			" Values ("+ integer +")";
	    	stmt.executeUpdate(insertSQL);
	    }
	    /////////////////////////////////////
	    List<Integer> list2 = new ArrayList<>();
	    ResultSet emId = stmt.executeQuery("SELECT EmployeeId From Employee");
	    while (emId.next()) {
	    	list2.add(emId.getInt(1));
	    }
	    
	    List<Integer> list3 = new ArrayList<>();
	    ResultSet supId = stmt.executeQuery("SELECT SupplierId From Supplier");
	    while (supId.next()) {
	    	list3.add(supId.getInt(1));
	    }
	    
	    List<Integer> list4 = new ArrayList<>();
	    ResultSet prodtId = stmt.executeQuery("SELECT ProductId From Product");
	    while (prodtId.next()) {
	    	list4.add(prodtId.getInt(1));
	    }
	    
	    for (Integer  n1: list2.subList(0, list2.size()/10)) {
	    	for (Integer n2 : list3.subList(0, list3.size()/10)) {
	    		for (Integer n3 : list4.subList(0, list4.size()/10)) {
	    			String insertSQL = "insert into delivers(EmployeeId,SupplierId,ProductId)" +
	    	    			" Values ("+n1+","+n2+","+n3+")";
	    	    	stmt.executeUpdate(insertSQL);
	    		}
	    	}	
	    }
	    //////////////////////////////////////
	    
	    
	    
	    ResultSet rs = stmt.executeQuery("SELECT COUNT(*) FROM Customer");
	    if (rs.next()) {
	      int count = rs.getInt(1);
	      System.out.println("Number of datasets Customer: " + count);
	    }
	    
	    rs = stmt.executeQuery("SELECT COUNT(*) FROM Product");
	    if (rs.next()) {
	      int count = rs.getInt(1);
	      System.out.println("Number of datasets Product: " + count);
	    }
	    
	     rs = stmt.executeQuery("SELECT COUNT(*) FROM Employee");
	    if (rs.next()) {
	      int count = rs.getInt(1);
	      System.out.println("Number of datasets Employee: " + count);
	    }
	    
	    rs = stmt.executeQuery("SELECT COUNT(*) FROM Supplier");
	    if (rs.next()) {
	      int count = rs.getInt(1);
	      System.out.println("Number of datasets Supplier: " + count);
	    }
	    
	    rs = stmt.executeQuery("SELECT COUNT(*) FROM Prime");
	    if (rs.next()) {
	      int count = rs.getInt(1);
	      System.out.println("Number of datasets prime: " + count);
	    }
	    
	    rs = stmt.executeQuery("SELECT COUNT(*) FROM delivers");
	    if (rs.next()) {
	      int count = rs.getInt(1);
	      System.out.println("Number of datasets delivers: " + count);
	    }
        
         //excute SQL query and return the number of rows in table
	    
	    String query = "DELETE FROM Prime";
	    int deletedRows=stmt.executeUpdate(query);
	    
	    query = "DELETE FROM delivers";
	    deletedRows=stmt.executeUpdate(query);
	    

	    
	    rs.close();
	    stmt.close();
	    con.close();
	    
	    //close the opend connections

	    System.out.println("Verbindung Ende");
	    }
	}

