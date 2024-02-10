using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using winProyecto.Datos;
using winProyecto.Entidades;

namespace winProyecto
{
    public partial class FrmAutenticar : Form
    {
        public FrmAutenticar()
        {
            InitializeComponent();
        }

        private void label1_Click(object sender, EventArgs e)
        {

        }

        private void button1_Click(object sender, EventArgs e)
        {
            UsuarioDA usuarioDA = new UsuarioDA();
            usuarioDA.GetList();
            Usuario usuario = usuarioDA.ValidaLogin(txtUsuario.Text,
           txtContrasenia.Text);
            if (usuario.idUsuario > 0)
            {
                Form1 form1 = new Form1(); form1.ShowDialog();
            }
            else
            {
                MessageBox.Show("Credenciales incorretas");
            }
        }

        private void txtUsuario_TextChanged(object sender, EventArgs e)
        {

        }
    }
}
