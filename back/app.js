const express = require('express'),
  app = express(),
  compression = require('compression'),
  helmet = require('helmet'),
  nodemailer = require('nodemailer'),
  bodyParser = require('body-parser')

app.set('view engine', 'ejs')
app.set('views', './front')

app.use(helmet())
app.use(compression())
app.use(express.static('./front/'))
app.use(bodyParser())

app.post('/contato', function(req, res) {
  nodemailer.createTestAccount((err, account) => {
    const transporter = nodemailer.createTransport({
      host: 'smtp.gmail.com',
      port: 465,
      secure: true,
      auth: {
        user: process.env.user,
        pass: process.env.pass
      }
    })



    let t = `nome: ${req.body.nome}, email: ${req.body.email}, telefone: ${req.body.telefone}, mensagem: ${req.body.mensagem}`

    const mailOptions = {
      from: `Contato Site <${process.env.user}>`,
      to: `${process.env.dest1}, ${process.env.dest2}`,
      subject: 'CONTATO',
      text: t,
      html: t
    }

    transporter.sendMail(mailOptions, (error, info) => {})
  })

  res.render('index.ejs', {
    msg: 'Email encaminhado com sucesso'
  })

})

app.get('/', function(req, res) {
  res.render('index.ejs', {msg: ''})
})

app.listen(process.env.PORT || 8080, function() {
  if (!process.env.PORT)
    console.log('Example app listening on port 8080!');
})
