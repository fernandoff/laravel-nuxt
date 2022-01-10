
export interface MetApiResponse {
  benchmark: number
  status: 'success' | 'failure'
  query: {
    options: Record<string, any>
    params: Record<string, any>
  }
  paginate?: {
    current_page: number
    first_item: number
    last_item: number
    last_page: number
    pages: Array<number>
    per_page: number
    total: number
  }
  data: any
}

export interface User {
  name: string
  job: string
  email: string
  phone: string
  avatar: string
}

export type Users = Array<User>

// PROFILE
export interface Profile {
  name?: string
  email?: string
  biography?: string
}

export type Profiles = Array<Profile>

// PORTFOLIOS
export interface Portfolio {
  id?: number,
  company?: string
  role?: string
  description?: string
  start?: Date | null
  end?: Date | null
}

export type Portfolios = Array<Portfolio>
