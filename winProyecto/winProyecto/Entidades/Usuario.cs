using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace winProyecto.Entidades
{
    public class Usuario
    {
        public int idUsuario {  get; set; }
        public string NombreUsuario { get; set;}
        public string Clave { get; set; }
        public string Salt { get; set; }
    }
}
