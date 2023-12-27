import com.linuxense.javadbf.DBFReader;
 
import java.io.*;
import java.nio.charset.StandardCharsets;
 
public class DBFtest{
    public static void main(String[] args) {
        String inputDBF = "mark2603.dbf";
        String outputCSV = "ausgabe.csv";
 
        try (InputStream fis = new FileInputStream(inputDBF);
             DBFReader reader = new DBFReader(fis);
             BufferedWriter writer = new BufferedWriter(new OutputStreamWriter(new FileOutputStream(outputCSV), StandardCharsets.UTF_8))) {
 
            // Zugriff auf den DBF-Header, um die Anzahl der Felder zu erhalten
            int fieldCount = reader.getFieldCount();
            String[] columnNames = new String[fieldCount];
 
            // Iteriere über die Felder und erhalte die Spaltennamen
            for (int i = 0; i < fieldCount; i++) {
                columnNames[i] = reader.getField(i).getName();
            }
 
            // Schreibe Header (Spaltennamen) in CSV
            writer.write(String.join(",", columnNames));
            writer.newLine();
 
            // Schreibe Datenzeilen in CSV
            Object[] row;
            while ((row = reader.nextRecord()) != null) {
                String rowString = "";
                for (Object value : row) {
                    if (value != null) {
                            
                             if(value.toString().contains(",")) {
                                             rowString += "\"" + value.toString() + "\",";}
                             else {
                                             rowString += value.toString() + ",";}
                    } else {
                        rowString += ",";
                    }
                }
                // Entferne das letzte Komma und schreibe die Zeile in die CSV-Datei
                writer.write(rowString.substring(0, rowString.length() - 1));
                writer.newLine();
            }
 
            System.out.println("Konvertierung abgeschlossen. CSV-Datei erstellt: " + outputCSV);
 
        } catch (IOException e) {
            e.printStackTrace();
        }
    }
}