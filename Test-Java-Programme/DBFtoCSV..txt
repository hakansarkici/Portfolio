import com.linuxense.javadbf.DBFReader;
import com.linuxense.javadbf.DBFDataType;
 
import java.io.FileInputStream;
import java.io.IOException;
import java.util.ArrayList;
import java.util.List;
import java.util.Map;
import java.util.HashMap;
 
public class SQLStatement {
               
    private static final String DBF_FILE_PATH = "arch_mar.dbf";
    private static final String TABLE_NAME = "\"public\".arch_mar";
    private static final String TABLE_DESTINATION = "\"public\".archmarkise";
 
    public static void main(String[] args) {
        try (FileInputStream fis = new FileInputStream(DBF_FILE_PATH);
             DBFReader reader = new DBFReader(fis)) {
 
            List<String> columnNames = new ArrayList<>();
            List<String> columnTypes = new ArrayList<>();
            List<String> columnTypesDes = new ArrayList<>();
            List<String> columnTypesSub = new ArrayList<>();
 
            extractColumnInformation(reader, columnNames, columnTypes, columnTypesDes, columnTypesSub);
 
            String sqlStatementTable = generateSQLStatement(TABLE_NAME, columnNames, columnTypes);
            String sqlStatementDestination = generateSQLStatement(TABLE_DESTINATION, columnNames, columnTypesDes);
 
            System.out.println(sqlStatementTable);
            System.out.println(sqlStatementDestination);
 
            String columnDefinitions = generateColumnDefinitions(columnNames, columnTypesSub);
            generateSQL(TABLE_DESTINATION, TABLE_NAME, columnDefinitions);
 
        } catch (IOException e) {
            e.printStackTrace();
        }
    }
 
    private static void extractColumnInformation(DBFReader reader, List<String> columnNames, List<String> columnTypes, List<String> columnTypesDes, List<String> columnTypesSub) {
        for (int i = 0; i < reader.getFieldCount(); i++) {
            columnNames.add(reader.getField(i).getName());
            columnTypes.add(determineDataType(reader.getField(i).getType()));
            columnTypesDes.add(determineDataTypeDes(reader.getField(i).getType()));
            columnTypesSub.add(determineDataTypeSub(reader.getField(i).getType()));
        }
    }
 
    private static String determineDataType(DBFDataType dataType) {
        switch (dataType) {
            case CHARACTER:
                return "varchar(200)";
            case DATE:
                return "varchar(200)";
            case FLOATING_POINT:
            case NUMERIC:
                return "varchar(200)";
            default:
                return "varchar(200)";
        }
    }
   
    private static String determineDataTypeDes(DBFDataType dataType) {
        switch (dataType) {
            case CHARACTER:
                return "varchar(200)";
            case DATE:
                return "varchar(55)";
            case FLOATING_POINT:
            case NUMERIC:
                return "varchar(55)";
            default:
                return "varchar(200)";
        }
    }
   
    private static String determineDataTypeSub(DBFDataType dataType) {
        switch (dataType) {
            case CHARACTER:
                return "200";
            case DATE:
                return "55";
            case FLOATING_POINT:
            case NUMERIC:
                return "55";
            default:
                return "200";
        }
    }
 
    private static String generateSQLStatement(String tableName, List<String> columnNames, List<String> columnTypes) {
        StringBuilder sqlStatement = new StringBuilder("CREATE TABLE " + tableName + " (\n");
 
        for (int i = 0; i < columnNames.size(); i++) {
            sqlStatement.append("    ").append(columnNames.get(i)).append(" ").append(columnTypes.get(i));
            if (i < columnNames.size() - 1) {
                sqlStatement.append(",");
            }
            sqlStatement.append("\n");
        }
 
        sqlStatement.append(");\n\n\n");
 
        return sqlStatement.toString();
    }
 
    private static String generateColumnDefinitions(List<String> columnNames, List<String> columnTypes) {
        StringBuilder columnDefinitions = new StringBuilder();
 
        for (int i = 0; i < columnNames.size(); i++) {
            columnDefinitions.append(columnNames.get(i)).append(" ").append(columnTypes.get(i));
            if (i < columnNames.size() - 1) {
                columnDefinitions.append(",\n");
            }
        }
 
        return columnDefinitions.toString();
    }
 
    private static void generateSQL(String targetTable, String sourceTable, String columnDefinitions) {
        Map<String, String> columnMapping = getColumnMapping(columnDefinitions);
        Map<String, String> datatypeMapping = getDatatypeMapping(columnDefinitions);
 
        StringBuilder sql = new StringBuilder();
        sql.append("INSERT INTO ").append(targetTable).append(" \n(");
 
        // Spalten für INSERT
        for (String targetColumn : columnMapping.keySet()) {
            sql.append(targetColumn).append(",\n");
        }
        sql.setLength(sql.length() - 2); // Letztes ", " entfernen
        sql.append(")\nSELECT\n");
 
        // Spalten für SELECT mit Datentypumwandlung
        for (Map.Entry<String, String> entry : columnMapping.entrySet()) {
            String targetColumn = entry.getKey();
            String sourceColumn = entry.getValue();
            String datatype = datatypeMapping.get(targetColumn);
 
            // Überprüfen, ob die Länge 200 ist
            if (datatype.equals("varchar(200)")) {
                sql.append("  ").append(sourceColumn).append(" AS ").append(targetColumn).append(",\n");
            } else {
                // Andernfalls SUBSTRING anwenden
                sql.append("  SUBSTRING(").append(sourceColumn).append(", 1, ").append(datatype).append(") AS ").append(targetColumn).append(",\n");
            }
        }
        sql.setLength(sql.length() - 2); // Letztes ", " entfernen
 
        // FROM-Klausel
        sql.append(" FROM ").append(sourceTable).append(";");
 
        System.out.println(sql.toString());
    }
 
    private static Map<String, String> getColumnMapping(String columnDefinitions) {
        // Mapping von Ziel- zu Quellspalten
        Map<String, String> columnMapping = new HashMap<>();
 
        String[] columns = columnDefinitions.split(",\\s*\\r?\\n");
        for (String column : columns) {
            String[] parts = column.trim().split("\\s+");
            if (parts.length == 2) {
                columnMapping.put(parts[0], parts[0]); // Ziel- und Quellspaltenname sind identisch
            } else {
                // Ungültiges Format behandeln
                System.err.println("Ungültiges Spaltenformat: " + column);
            }
        }
 
        return columnMapping;
    }
 
    private static Map<String, String> getDatatypeMapping(String columnDefinitions) {
        // Mapping von Zielspalten zu neuen Datentypen
        Map<String, String> datatypeMapping = new HashMap<>();
 
        String[] columns = columnDefinitions.split(",\\s*\\r?\\n");
        for (String column : columns) {
            String[] parts = column.trim().split("\\s+");
            if (parts.length == 2) {
                datatypeMapping.put(parts[0], parts[1]);
            } else {
                // Ungültiges Format behandeln
                System.err.println("Ungültiges Spaltenformat: " + column);
            }
        }
 
        return datatypeMapping;
    }
}