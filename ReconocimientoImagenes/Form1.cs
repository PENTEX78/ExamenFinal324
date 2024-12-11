using Emgu.CV.Structure;
using Emgu.CV;
using Emgu.CV.CvEnum;
using System;
using System.Drawing;
using System.Windows.Forms;
using Emgu.CV.Util;

namespace ReconocimientoImagenes
{
    public partial class Form1 : Form
    {
        private Image<Bgr, byte> imagenOriginal;
        public Form1()
        {
            InitializeComponent();
        }


        private void Form1_Load(object sender, EventArgs e)
        {

        }
        private void button1_Click(object sender, EventArgs e)
        {
            // Abrir un cuadro de diálogo para seleccionar la imagen
            OpenFileDialog openFileDialog = new OpenFileDialog();
            openFileDialog.Filter = "Archivos de imagen|*.jpg;*.png;*.bmp";

            if (openFileDialog.ShowDialog() == DialogResult.OK)
            {
                // Cargar la imagen seleccionada
                imagenOriginal = new Image<Bgr, byte>(openFileDialog.FileName);
                pictureBox1.Image = imagenOriginal.ToBitmap();

            }
        }

        private void button2_Click(object sender, EventArgs e)
        {
            if (imagenOriginal == null)
            {
                MessageBox.Show("Primero carga una imagen.", "Advertencia", MessageBoxButtons.OK, MessageBoxIcon.Warning);
                return;
            }

            // Convertir la imagen a escala de grises para procesarla mejor
            var imagenGris = imagenOriginal.Convert<Gray, byte>();

            // Suavizado para reducir el ruido
            var imagenSuavizada = imagenGris.SmoothGaussian(5);

            // Usar Canny para detectar bordes en la imagen
            var imagenBordes = new UMat();
            CvInvoke.Canny(imagenSuavizada, imagenBordes, 100, 200);

            // Detectar contornos en la imagen con bordes
            var contornos = new VectorOfVectorOfPoint();
            Mat jerarquia = new Mat();
            CvInvoke.FindContours(imagenBordes, contornos, jerarquia, RetrType.External, ChainApproxMethod.ChainApproxSimple);

            // Dibujar los contornos de las zonas urbanas y carreteras en la imagen original
            for (int i = 0; i < contornos.Size; i++)
            {
                // Dibujar contornos de las zonas urbanas y carreteras
                // Puedes usar diferentes colores para distinguir las zonas urbanas y las carreteras
                // Aquí se usan colores rojo (zonas urbanas) y verde (carreteras)
                if (EsCarretera(contornos[i]))
                {
                    CvInvoke.DrawContours(imagenOriginal, contornos, i, new MCvScalar(0, 255, 0), 2); // Verde para carreteras
                }
                else
                {
                    CvInvoke.DrawContours(imagenOriginal, contornos, i, new MCvScalar(0, 255, 0), 2); // Rojo para zonas urbanas
                }
            }

            // Mostrar la imagen procesada con las zonas delimitadas en el PictureBox
            pictureBox2.Image = imagenOriginal.ToBitmap();
        }

        private bool EsCarretera(VectorOfPoint contorno)
        {
            // Aquí puedes aplicar un criterio de tamaño, forma o ubicación
            // En este ejemplo, usamos un área de contorno pequeña para identificar las carreteras
            double area = CvInvoke.ContourArea(contorno);
            return area < 1000; // Las carreteras suelen ser más pequeñas en área que las zonas urbanas
        }

    }
}
