package developer.hakan;
 
import java.io.FileWriter;
import java.io.IOException;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.ResultSetMetaData;
import java.sql.SQLException;
import java.time.Duration;
import java.time.Instant;
 
import ajo.AbstractAjoAccess;
import de.abas.erp.db.DbContext;
 
public class auDBFe extends AbstractAjoAccess {
     
      //erstellt eine Textdatei, die man dann als Klasse einfügen kann um Posti durchzuführen
 
    private static final String PFAD = "demo/test/DBF_TEST";
    private static final String DBF = "\"arch_ma1.dbf\"";
 
    private DbContext ctx = null;
 
    @Override
    public int run(String[] args) {
        ctx = getDbContext();
 
        Instant start = Instant.now();
 
        sqlZwischenklasseErstellung();
 
        ctx.out().println("Dauer neu: " + Duration.between(start, Instant.now()));
 
        return 0;
    }
 
    private void sqlZwischenklasseErstellung() {
        int iStatus = 0;
        ctx.out().println("holFertig gestartet");
 
        String sStmt = "SELECT * FROM " + DBF + " WHERE komm = '7/515393 -la'";
        String pfad = "jdbc:jstels:dbf:/erp/abas/" + PFAD;
 
        try {
            Class.forName("jstels.jdbc.dbf.DBFDriver");
        } catch (ClassNotFoundException e) {
            ctx.out().println(e.getMessage());
            return;
        }
 
        String uebergabenametype = "";
        ctx.out().println("jdbc treiber da");
 
        try (Connection connDB = DriverManager.getConnection(pfad);
             PreparedStatement psStmt = connDB.prepareStatement(sStmt);
             ResultSet rsDBF = psStmt.executeQuery()) {
 
            ctx.out().println("jdbc verbindung vollständig");
 
            uebergabenametype = processResultSet(rsDBF);
 
        }catch (Exception e) {
                  ctx.out().println(e.getMessage());
            }
 
        DynamicClassGenerator(ctx, uebergabenametype, DBF);
 
        ctx.out().println("Code HolFertig Fertig");
    }
 
    private String processResultSet(ResultSet rsDBF) throws SQLException {
       
 
        String uebergabenametype = "";
        ResultSetMetaData metaData = rsDBF.getMetaData();
        int columnCount = metaData.getColumnCount();
 
        for (int i = 1; i <= columnCount; i++) {
            String columnName = metaData.getColumnName(i) + " ";
            String columnType = metaData.getColumnTypeName(i);
 
            // Mapping SQL types to Java types
            // (consider using a map or switch statement for better maintainability)
            if (columnType.equals("INTEGER"))
                columnType = "Integer";
            else if (columnType.equals("TIMESTAMP"))
                columnType = "Date";
            else if (columnType.equals("VARCHAR"))
                columnType = "String";
            else if (columnType.equals("BOOLEAN"))
                columnType = "Boolean";
            else if (columnType.equals("DOUBLE"))
                columnType = "Double";
 
            uebergabenametype = uebergabenametype + columnName + "." + columnType + ",";
        }
 
        return uebergabenametype;
    }
 
      public int DynamicClassGenerator(DbContext ctx, String uebergabe, String className) {
 
            // Dynamisch Klasse generieren
            StringBuilder classTemplate = generateClassTemplate(className, uebergabe, ctx);
 
            // Ausgabe der generierten Klasse
            String Outputfilename = "/erp/abas/demo/test/test_klasse.txt";
            FileWriter writer;
            try {
                  writer = new FileWriter(Outputfilename);
                  writer.write(classTemplate.toString());
                  writer.close();
            } catch (IOException e) {
                  // TODO Auto-generated catch block
                  e.printStackTrace();
                  ctx.out().println(e);
            }
            ctx.out().println("Ausgabe gedruckt");
 
            return 0;
      }
 
      private static StringBuilder generateClassTemplate(String className, String input, DbContext ctx) {
            String[] variableDefinitions = input.split(",");
            StringBuilder classTemplate = new StringBuilder();
            classTemplate.append("public class ").append(className).append(" {\n");
            Integer zaehler = 1;
 
            for (String variableDefinition : variableDefinitions) {
                  String[] parts = variableDefinition.split("\\.");
                  if (parts.length == 2) {
                        String variableName = "value"+zaehler.toString();
                        String variableType = parts[1];
                        if (variableName.contains(";"))
                              variableName = variableName.replace(";", "");
                        if (variableType.contains(";"))
                              variableType = variableType.replace(";", "");
                        classTemplate.append("    private ").append(variableType).append(" ").append(variableName).append(";\n");
                        zaehler++;
                  } else {
                        ctx.out().println("Ungültige Eingabe für Variable: " + variableDefinition);
                  }
            }zaehler=1;
 
            // Konstruktor hinzufügen
            classTemplate.append("\n    public ").append(className).append("(");
 
            for (String variableDefinition : variableDefinitions) {
                  String[] parts = variableDefinition.split("\\.");
                  if (parts.length == 2) {
                        String variableName = "value"+zaehler.toString();
                        String variableType = parts[1];
                        if (variableName.contains(";"))
                              variableName = variableName.replace(";", "");
                        if (variableType.contains(";"))
                              variableType = variableType.replace(";", "");
                        classTemplate.append(variableType).append(" ").append(variableName).append(", ");
                        zaehler++;
                  }
            }zaehler=1;
 
            // Entferne das letzte ", " vom Konstruktor
            classTemplate.setLength(classTemplate.length() - 2);
 
            classTemplate.append(") {\n");
 
            // Setze Werte im Konstruktor
            for (String variableDefinition : variableDefinitions) {
                  String[] parts = variableDefinition.split("\\.");
                  if (parts.length == 2) {
                        String variableName = "value"+zaehler.toString();
                        if (variableName.contains(";"))
                              variableName = variableName.replace(";", "");
                        if (variableName.contains(" ")) {
                              variableName = variableName.replace(" ", "");
                              if (variableName.contains(" ")) {
                                   variableName = variableName.replace(" ", "");
                              }
                        }
                        classTemplate.append("        this.").append(variableName).append(" = ").append(variableName).append(";\n");
                        zaehler++;
                  }
            }zaehler=1;
 
            classTemplate.append("    }\n");
 
            // Getter-Methoden hinzufügen
            for (String variableDefinition : variableDefinitions) {
                  String[] parts = variableDefinition.split("\\.");
                  if (parts.length == 2) {
                        String variableName = "value"+zaehler.toString();
                        if (variableName.contains(";")) {
                              variableName = variableName.replace(";", "");
                        }
                        if (variableName.contains(" ")) {
                              variableName = variableName.replace(" ", "");
                              if (variableName.contains(" ")) {
                                   variableName = variableName.replace(" ", "");
                              }
                        }
                        String getterMethodName = "get" + variableName.substring(0, 1).toUpperCase() + variableName.substring(1);
                        classTemplate.append("\n    public ").append(parts[1]).append(" ").append(getterMethodName).append("() {\n");
                        classTemplate.append("        return ").append(variableName).append(";\n");
                        classTemplate.append("    }\n");
                        zaehler++;
                  }
            }zaehler=1;
 
            classTemplate.append("}");
            classTemplate.append("\n");
            classTemplate.append("\n");
            int lastIndex = variableDefinitions.length;
           
            classTemplate.append("INSERT INTO ").append(className).append(" ( ");
            for (String variableDefinition : variableDefinitions) {
                  String[] parts = variableDefinition.split("\\.");
                  if (parts.length == 2) {
                        String variableName = parts[0].toLowerCase();
                        if (variableName.contains(";"))
                              variableName = variableName.replace(";", "");
                        if (variableName.contains(" "))
                              variableName = variableName.replace(" ", "");
                       
                        if (zaehler == lastIndex) {
                              classTemplate.append(variableName).append(" ");
                      }else{
                        classTemplate.append(variableName).append(",").append(" ");
                      }
                       
                        zaehler++;
                  }
            }
            classTemplate.append(") VALUES (");
            for(int i = 1; i<=zaehler; i++){
                  if(i==zaehler)
                        classTemplate.append("? ");
                  else
                        classTemplate.append("?, ");
            }
            classTemplate.append(") \n");
            classTemplate.append(") \n");
 
            zaehler=1;
            return classTemplate;
      }
 
}