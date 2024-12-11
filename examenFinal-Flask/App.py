from flask import Flask, render_template, request, redirect, flash, url_for
from flask_mysqldb import MySQL

app = Flask(__name__)
app.secret_key = 'sfAWAWGgadaeoaEesEGagasGAGJPJjP'

app.config['MYSQL_HOST'] = 'localhost'
app.config['MYSQL_USER'] = 'root'
app.config['MYSQL_PASSWORD'] = ''
app.config['MYSQL_DB'] = 'bd_sistemaescolar'

mysql = MySQL(app)

# Ruta para el index
@app.route('/')
def Index():
    cursor = mysql.connection.cursor()
    query = " select e.id, e.nombre, e.apellido, e.fecha_nacimiento, c.nombre as clase_nombre from estudiantes e, clases c where e.clase_id = c.id order by e.id"
    cursor.execute(query)
    data = cursor.fetchall()
    return render_template('index.html', estudiantes = data)

# Ruta para agregar al estudiante
@app.route('/agregarEstudiante', methods = ['GET', 'POST'])
def agregarEstudiante():
    if request.method == 'POST':
        nombre = request.form['nombre']
        apellido = request.form['apellido']
        fecha_nacimiento = request.form['fecha_nacimiento']
        clase_id = request.form['clase_id']

        # Agregar estudiante a la base de datos y redireccionar a la vista de lista de estudiantes
        cursor = mysql.connection.cursor()
        cursor.execute("INSERT INTO estudiantes (nombre, apellido, fecha_nacimiento, clase_id) VALUES (%s, %s, %s, %s)", (nombre, apellido, fecha_nacimiento, clase_id))
        mysql.connection.commit()
        cursor.close()

        return redirect('/')
    
    # Obtener las clases para el formulario
    cursor = mysql.connection.cursor()
    cursor.execute("SELECT id, nombre, grado FROM clases")
    data = cursor.fetchall()
    cursor.close()
    return render_template('agregarEstudiante.html', clases = data)

# Ruta para agregar materia
@app.route('/agregarMateria', methods = ['GET','POST'])
def agregarMateria():
    if request.method == 'POST':
        nombre = request.form['nombre']

        # Agregar materia a la base de datos y redireccionar a la vista
        cursor = mysql.connection.cursor()
        cursor.execute("INSERT INTO materias (nombre) VALUES (%s)", (nombre,))
        mysql.connection.commit()
        cursor.close()    
        return redirect('/agregarMateria') 

    cursor = mysql.connection.cursor()
    cursor.execute("SELECT id, nombre FROM materias ORDER BY id")
    materias = cursor.fetchall()  # Obtiene todas las materias como lista de tuplas
    cursor.close()
    return render_template('agregarMateria.html', materias=materias, enumerate=enumerate)

# Ruta para eliminar estudiante recibiendo el id
@app.route('/eliminarEstudiante<int:id>', methods = ['POST'])
def eliminarEstudiante(id):
    cursor = mysql.connection.cursor()
    query = "DELETE FROM estudiantes WHERE id = %s"
    cursor.execute(query, (id,))
    mysql.connection.commit()
    flash("Estudiante eliminado exitosamente.", "success")
    return redirect('/')

# Ruta para eliminar una materia
@app.route('/eliminarMateria/<int:id>', methods=['POST'])
def eliminar_materia(id):
    cursor = mysql.connection.cursor()
    query = "DELETE FROM materias WHERE id = %s"
    cursor.execute(query, (id,))
    mysql.connection.commit()
    cursor.close()
    return redirect('/agregarMateria')

# Ruta para editar al estudiante 
@app.route('/editarEstudiante/<int:id>', methods = ['GET', 'POST'])
def editarEstudiante(id):
    # Buscar estudiante por id
    cursor = mysql.connection.cursor()
    cursor.execute("SELECT * FROM estudiantes WHERE id = %s", (id,))
    data = cursor.fetchone()

    # Buscar las opciones para las clases
    cursor.execute('Select * from clases')
    data2 = cursor.fetchall()

    if request.method == 'POST':
        # Obtener los datos del formulario
        nombre = request.form['nombre']
        apellido = request.form['apellido']
        fecha_nacimiento = request.form['fecha_nacimiento']
        clase_id = request.form['clase_id']

        # Actualizar el estudiante en la base de datos
        cursor.execute("UPDATE estudiantes SET nombre = %s, apellido = %s, fecha_nacimiento = %s, clase_id = %s WHERE id = %s", (nombre, apellido, fecha_nacimiento, clase_id, id))

        # Guardar cambios y redirigir
        mysql.connection.commit()
        return redirect('/')
    
    return render_template('editarEstudiante.html', estudiante = data, clases = data2)

# Ruta para ver las notas de cada estudiante
@app.route('/verNotas/<int:id>')
def verNotas(id):
    # lista las notas mediante el id
    cursor = mysql.connection.cursor()
    cursor.execute("SELECT estudiantes.nombre, estudiantes.apellido, materias.nombre AS materia, notas.id_nota, notas.fecha, notas.id FROM estudiantes, materias, notas WHERE estudiantes.id = notas.id_estudiante AND materias.id = notas.id_materia AND estudiantes.id = %s ", (id,))
    data = cursor.fetchall()

    # Obtener el nombre completo del estudiante
    estudiante_nombre = data[0][0] + " " + data[0][1] if data else "Estudiante no encontrado"

    return render_template('verNotas.html', notas = data, estudiante_nombre = estudiante_nombre)

# Funcion para la logica y enviar a la vista sobre la nota
@app.route('/editarNota/<int:id>', methods = ['GET', 'POST']) 
def editarNota(id):
    # Buscar nota por id
    cursor = mysql.connection.cursor()
    cursor.execute("SELECT notas.id, materias.nombre AS materia, notas.id_nota, notas.fecha, notas.id_estudiante FROM notas, materias WHERE notas.id_materia = materias.id AND notas.id = %s", (id,))
    data = cursor.fetchone()

    if request.method == 'POST':
        # Obtener los datos del formulario
        nueva_nota = request.form['nota']
        # Actualizar el estudiante en la base de datos
        cursor.execute("UPDATE notas SET id_nota = %s WHERE id = %s", (nueva_nota, id))
        # Guardar cambios y redirigir
        mysql.connection.commit()
        # Redirigir a la página de notas del estudiante
        return redirect(url_for('verNotas', id = data[4]))
    
    return render_template('editarNota.html', nota = data)

if __name__ == '__main__':
    app.run(port = 5000, debug = True)

