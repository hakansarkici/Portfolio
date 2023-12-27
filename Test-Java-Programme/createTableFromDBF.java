package developer.hakan;
 
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.ResultSetMetaData;
import java.sql.SQLException;
import java.sql.Statement;
import java.time.Duration;
import java.time.Instant;
 
import ajo.AbstractAjoAccess;
import de.abas.erp.db.DbContext;
 
public class createTableFromDBF extends AbstractAjoAccess {
 
    private DbContext ctx = null;
    private static final String Pfad = "demo/test/DBF_TEST";
    private static final String DBF = "\"arch_ma1.dbf\"";
    private static final String Tabelle = "arch_martest2";
    //die DBF datei muss unter /erp/abas/ abgelegt werden und der Pfad ergängt werden
 
    public int run(String[] args) {
        ctx = getDbContext();
        Instant start = Instant.now();
 
        // Uncomment the desired method call
//        this.createTableFromDBF(ctx, "DBF_TEST", "\"arch_ma1.dbf\"", "arch_mar");
        this.createTable(ctx, Pfad, DBF, Tabelle);
 
        ctx.out().println("Duration: " + Duration.between(start, Instant.now()));
        return 0;
    }
 
    // Method to create a table in PostgreSQL from a DBF file
    protected void createTable(DbContext ctx, String sPfad, String sDbf, String sqlTab) {
        String sStmt = "SELECT * FROM " + sDbf + " WHERE komm = '7/515393 -la'";
        sPfad = "jdbc:jstels:dbf:/erp/abas/" + sPfad;
 
        StringBuilder sqlCreateStatement = new StringBuilder();
 
        try {
            Class.forName("jstels.jdbc.dbf.DBFDriver");
            ctx.out().println("JDBC Driver loaded.");
        } catch (ClassNotFoundException e) {
            ctx.out().println(e.getMessage());
            return;
        }
 
        try (Connection connDB = DriverManager.getConnection(sPfad);
             PreparedStatement psStmt = connDB.prepareStatement(sStmt);
             ResultSet rsDBF = psStmt.executeQuery()) {
 
            ResultSetMetaData metaData = rsDBF.getMetaData();
            int columnCount = metaData.getColumnCount();
 
            ctx.out().println("Generating SQL create statement for table " + sqlTab);
            sqlCreateStatement.append("CREATE TABLE \"public\".").append(sqlTab).append(" (");
 
            for (int i = 1; i <= columnCount; i++) {
                String columnName = metaData.getColumnName(i) + " ";
                String columnType = metaData.getColumnTypeName(i);
 
                // Map DBF column types to PostgreSQL types
                columnType = mapDBFTypeToPostgresType(columnType);
 
                // Append column definition to SQL create statement
                if (i == columnCount) {
                    ctx.out().println(columnName + columnType);
                    sqlCreateStatement.append(columnName).append(columnType);
                } else {
                    ctx.out().println(columnName + columnType + ",");
                    sqlCreateStatement.append(columnName).append(columnType).append(",");
                }
            }
 
            ctx.out().println(");");
            sqlCreateStatement.append(");");
 
            // Print and execute the SQL create statement
            ctx.out().println("SQL Create Statement:\n" + sqlCreateStatement.toString());
            createTable(ctx, sqlCreateStatement);
 
        } catch (Exception e) {
            ctx.out().println(e.getMessage());
        }
    }
 
    // Map DBF column types to PostgreSQL types
    private String mapDBFTypeToPostgresType(String dbfType) {
        switch (dbfType) {
            case "INTEGER":
                return "NUMERIC(10)";
            case "TIMESTAMP":
                return "DATE";
            case "VARCHAR":
                return "VARCHAR(255)";
            case "DOUBLE":
                return "NUMERIC(15,5)";
            // Add more mappings as needed
            default:
                return dbfType;
        }
    }
 
    // Method to create a table in PostgreSQL
    private void createTable(DbContext ctx, StringBuilder createStatement) {
        String connPost = "jdbc:postgresql://192.168.6.129:5432/postgres";
        try (Connection conn = DriverManager.getConnection(connPost, "postgres", "db2su")) {
            ctx.out().println("Connected to PostgreSQL.");
 
            String createTableQuery = createStatement.toString();
 
            try (Statement statement = conn.createStatement()) {
                statement.executeUpdate(createTableQuery);
                ctx.out().println("New table created in PostgreSQL.");
            }
 
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }
}
