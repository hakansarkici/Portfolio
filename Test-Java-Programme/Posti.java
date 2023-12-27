package developer.hakan;
 
import java.sql.Connection;
import java.sql.Date;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;
import java.lang.reflect.Field;
 
import ajo.AbstractAjoAccess;
import de.abas.erp.db.DbContext;
 
public class Posti extends AbstractAjoAccess{
     
     
     
      DbContext ctx = null;
      @Override
      public int run(String[] args)
      {    
            ctx = getDbContext();
           
            this.open(ctx);
           
            return 0;
      }
 
      private void open(DbContext ctx) {
        String connPost = "jdbc:postgresql://192.168.6.129:5432/postgres";
        Connection conn = null;
        ctx.out().println("Programm Gestartet.");
 
        try {
            Class.forName("org.postgresql.Driver");
            conn = DriverManager.getConnection(connPost, "postgres", "db2su");
           
            ctx.out().println("Zugriff auf Postgres.");
 
            // Annahme: Die Tabelle in der Datenbank hat die Spalten "spalte1", "spalte2", "spalte3"
            String insertQuery = "INSERT INTO arch_mar3 (nachname, wohnort, li_datum, komm, wahrheit, datum, nummer, doppelnummer) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            // , kdienst, ei_datum, au_datum, be_datum, stueck, code7, typ, breite, ausfall, kurbel, kurbvario, reg_farbe, reg_laenge, boecke, sparren, arme, kuerzel, blende, sonnenw, rechnung, preis, druck, zusatz, sonstiges, stoff_da, fertig, fertigung, verl_dsh, stop, freigabe, vv_hoehe, markise, muster, farbkit, montageart, uzh, kreuzplatt, kreuzplgr, vplatte, aart, ersnr, funkfern, farbe, antrieb, antriebsei, rsd, regulator, vv, vvfarbe, balkonf, sondstahl, rueckwand, motor, anzbock, tuchschale, ladeid, tourid, ladeterm, tourterm, status, prio, tourtyp, verschoben, woche, jahr, storno, verzug, verzugl, auftr_dat, fixkw, ralfarbe, org_best, versand, lpunkte, zubok, stahlstck, gekoppelt, rsd_halter, markplatt, liste, int_info, ifu, wsw, wswuno, wswib, regenw, upschalt, centuno, hirschk, zushs, zushsm, disthalter, couponware, anschlussk, ssttext, abas, dsh150, dsh300, up240200, mp240320, mp240390, ap060180, dshvl500, haddp, hadrp, dshrp, disthal150, disthal200, agplatt, agstueck, wanddeckht, zubehoer, blitz, tt_status, fixtermin, ap7019512, ap7019525, ap7014012, ap7014025, ap14011010, ap14010010, ifu_wind, ifu_swind, akzentleu, haltepfost, bodenkons, griffhalt, montpl_sm, seitenwgri, seitenwwan, zv_anz, zv_hoehe, zv_breite, sstpreis, tv_grund, mass_uf, rp_seitend, rp_designe, kompelem, breite_z, ausfall_z, stuetzenh, bocknr, bockdatum, zip_abstan, zip_ab_stk, zip_kabaus, paketanz, nhk, sst_beschi, dsh200, antrsei_vv, ma_esa, ma_beleuch, ma_bellge, ma_despa, ma_desekap, ma_vvart, ma_vvsto, ma_vvscree, trans_os, vers_os
           
            // Annahme: Du hast eine Liste von Daten, die du einfügen möchtest
            List<arch_mar> dataList = getSampleData();
            ctx.out().println("dataList geholt.");
 
            try (PreparedStatement preparedStatement = conn.prepareStatement(insertQuery)) {
                  ctx.out().println("Daten Setzen in Postgres.");
                for (arch_mar data : dataList) {
                  ctx.out().print(".");
                    // Setze die Werte für die Placeholder (?)
                  setValues(preparedStatement, data);
 
                    // Führe das Insert-Statement aus
                    preparedStatement.executeUpdate();
                }
 
                ctx.out().println("Daten erfolgreich eingefügt.");
            }
 
        } catch (ClassNotFoundException | SQLException e) {
            ctx.out().println(e.getMessage());
            for (StackTraceElement ste : e.getStackTrace()){
                  ctx.out().println(ste.toString());
            }
        } finally {
            // Schließe die Verbindung
            try {
                if (conn != null) {
                    conn.close();
                }
            } catch (SQLException e) {
                e.printStackTrace();
            }
        }
    }
 
    private static List<arch_mar> getSampleData() {
        // Annahme: Du hast eine Methode, die Daten zurückgibt, die du in die Tabelle einfügen möchtest
        List<arch_mar> dataList = new ArrayList<>();
 
        // Füge einige Beispieldaten hinzu
        java.util.Date currentDate = new java.util.Date();//muss später wieder weg
        java.sql.Date sqlDate = new java.sql.Date(currentDate.getTime());
 
        dataList.add(new arch_mar("Nachname13", "Wohnort1", "lieferdatum1","komm12", null, sqlDate, sqlDate, sqlDate, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, sqlDate, null, true, null, null, sqlDate, sqlDate, sqlDate, 5665, sqlDate, sqlDate, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, sqlDate, sqlDate, null, null, null, sqlDate, null, null, null, null, null, sqlDate, null, null, null, sqlDate, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, sqlDate, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, 784.658, null, null, null, null, null, null, null, null, null, sqlDate, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, sqlDate, sqlDate));
        dataList.add(new arch_mar("Nachname43", "Wohnort1", "lieferdatum2","komm23", null, sqlDate, sqlDate, sqlDate, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, sqlDate, null, true, null, null, sqlDate, sqlDate, sqlDate, 5665, sqlDate, sqlDate, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, sqlDate, sqlDate, null, null, null, sqlDate, null, null, null, null, null, sqlDate, null, null, null, sqlDate, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, sqlDate, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, 784.658, null, null, null, null, null, null, null, null, null, sqlDate, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, sqlDate, sqlDate));
 
        return dataList;
    }
   
    private void setValues(PreparedStatement preparedStatement, arch_mar data) throws SQLException {
        try {
            Field[] fields = arch_mar.class.getDeclaredFields();
 
            for (int i = 0; i < fields.length; i++) {
                Field field = fields[i];
                field.setAccessible(true);
 
                Object value = field.get(data);
 
                // Handle each data type
                if (value instanceof String) {
                    preparedStatement.setString(i + 1, (String) value);
                } else if (value instanceof Boolean) {
                    preparedStatement.setBoolean(i + 1, (Boolean) value);
                } else if (value instanceof Date) {
                    preparedStatement.setDate(i + 1, (Date) value);
                } else if (value instanceof Integer) {
                    preparedStatement.setInt(i + 1, (Integer) value);
                } else if (value instanceof Double) {
                    preparedStatement.setDouble(i + 1, (Double) value);
                } // add more data types if needed
            }
        } catch (IllegalAccessException e) {
            throw new SQLException("Error setting values for PreparedStatement", e);
        }
    }
     
}