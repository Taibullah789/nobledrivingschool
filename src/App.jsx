import { BrowserRouter as Router, Routes, Route } from 'react-router-dom'
import Header from './components/Header'
import Footer from './components/Footer'
import HomePage from './pages/HomePage'
import AboutPage from './pages/AboutPage'
import ServicesPage from './pages/ServicesPage'
import ContactPage from './pages/ContactPage'
import BlogPage from './pages/BlogPage'
import BlogPostPage from './pages/BlogPostPage'
import BlogPostPage2 from './pages/BlogPostPage2'
import BlogPostPage3 from './pages/BlogPostPage3'
import BlogPostPage4 from './pages/BlogPostPage4'
import RegistrationFormPage from './pages/RegistrationFormPage'

function App() {
  return (
    <Router>
      <div className="min-h-screen bg-white">
        <Header />
        <Routes>
          <Route path="/" element={<HomePage />} />
          <Route path="/about" element={<AboutPage />} />
          <Route path="/services" element={<ServicesPage />} />
          <Route path="/contact" element={<ContactPage />} />
          <Route path="/blogs" element={<BlogPage />} />
          <Route path="/blog-post" element={<BlogPostPage />} />
          <Route path="/blog-post-2" element={<BlogPostPage2 />} />
          <Route path="/blog-post-3" element={<BlogPostPage3 />} />
          <Route path="/blog-post-4" element={<BlogPostPage4 />} />
          <Route path="/registration-form" element={<RegistrationFormPage />} />
        </Routes>
        <Footer />
      </div>
    </Router>
  )
}

export default App
