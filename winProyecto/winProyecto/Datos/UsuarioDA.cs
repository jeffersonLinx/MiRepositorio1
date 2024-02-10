using System;
using System.Collections;
using System.Collections.Generic;
using System.Configuration;
using System.Data.SqlClient;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using winProyecto.Entidades;

namespace winProyecto.Datos
{
    public class UsuarioDA
    {
        private string cadenaDeConexion;
          
        public UsuarioDA()
        {
            cadenaDeConexion = ConfigurationManager.ConnectionStrings["MiProyecto"].ConnectionString;
        }
        List<Usuario> list = new List<Usuario>();
        public List<Usuario> GetListPrueba()
        {
            
            Usuario l1 = new Usuario();
            l1.idUsuario = 1;
            l1.NombreUsuario = "David";
            list.Add(l1);
            Usuario l2 = new Usuario();
            l2.idUsuario = 2;
            l2.NombreUsuario = "Juan";
            list.Add(l2);
            return list;

        }
        public Usuario ValidaLogin(string NombreUsuario, string Clave)
        {
            Usuario oUsuario = new Usuario();
            oUsuario.idUsuario = 0;
            foreach (Usuario objLista in list)
            {
                if (objLista.NombreUsuario == NombreUsuario && objLista.Clave == Clave)
                {
                    oUsuario.idUsuario = objLista.idUsuario;
                    oUsuario.Salt = objLista.Salt;
                }
            }
            return oUsuario;
        }
        public List<Usuario> GetList()
        {
            List<Usuario> ListUsuario = new List<Usuario>();
            Usuario l;
            using (SqlConnection conn = new SqlConnection(cadenaDeConexion))
            {
                conn.Open();
                SqlCommand cmd = new SqlCommand("select * from trnUsuario; ", conn);
                using (SqlDataReader reader = cmd.ExecuteReader())
                {
                    while (reader.Read())
                    {
                        l = new Usuario();
                        l.idUsuario = Convert.ToInt32(reader["idUsuario"]);
                        l.NombreUsuario = Convert.ToString(reader["NombreUsuario"]);
                        l.Clave = Convert.ToString(reader["Clave"]);
                        ListUsuario.Add(l);

                    }
                }
            }
            return ListUsuario;

        }
    }
    // PARTE 2
  
    //parte 3
}
